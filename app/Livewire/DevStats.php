<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class DevStats extends Component
{
    public ?array $github = null;

    public ?array $codeberg = null;

    public array $latestRepos = [];

    public function mount(): void
    {
        $githubRepos = $this->fetchGithubRepos();
        $codebergRepos = $this->fetchCodebergRepos();

        $this->github = $this->summarizeGithub($githubRepos);
        $this->codeberg = $this->summarizeCodeberg($codebergRepos);
        $this->latestRepos = $this->buildLatestRepos($githubRepos, $codebergRepos);
    }

    private function buildLatestRepos(array $githubRepos, array $codebergRepos): array
    {
        try {
            return collect($githubRepos)
                ->reject(fn ($repo) => $repo['fork'] || strcasecmp($repo['name'], 'konkazazis') === 0)
                ->map(fn ($repo) => [
                    'platform'    => 'GitHub',
                    'name'        => $repo['name'],
                    'description' => $repo['description'],
                    'language'    => $repo['language'],
                    'stars'       => $repo['stargazers_count'],
                    'url'         => $repo['html_url'],
                    'pushed_at'   => Carbon::parse($repo['pushed_at']),
                ])
                ->merge(
                    collect($codebergRepos)
                        ->reject(fn ($repo) => $repo['fork'] || $repo['name'] === '.profile')
                        ->map(fn ($repo) => [
                            'platform'    => 'Codeberg',
                            'name'        => $repo['name'],
                            'description' => $repo['description'],
                            'language'    => $repo['language'],
                            'stars'       => $repo['stars_count'],
                            'url'         => $repo['html_url'],
                            'pushed_at'   => Carbon::parse($repo['updated_at']),
                        ])
                )
                ->sortByDesc('pushed_at')
                ->take(5)
                ->values()
                ->all();
        } catch (\Throwable $e) {
            Log::warning('Failed to build latest repos list: '.$e->getMessage());

            return [];
        }
    }

    private function fetchGithubRepos(): array
    {
        return Cache::remember('dev-stats:github:repos', now()->addHours(6), function () {
            try {
                return Http::timeout(5)
                    ->get('https://api.github.com/users/konkazazis/repos', ['per_page' => 100])
                    ->throw()
                    ->json();
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch GitHub repos: '.$e->getMessage());

                return [];
            }
        });
    }

    private function fetchCodebergRepos(): array
    {
        return Cache::remember('dev-stats:codeberg:repos', now()->addHours(6), function () {
            try {
                return Http::timeout(5)
                    ->get('https://codeberg.org/api/v1/users/konkazazis/repos', ['limit' => 50])
                    ->throw()
                    ->json();
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch Codeberg repos: '.$e->getMessage());

                return [];
            }
        });
    }

    private function summarizeGithub(array $repos): ?array
    {
        if (empty($repos)) {
            return null;
        }

        return Cache::remember('dev-stats:github:summary', now()->addHours(6), function () use ($repos) {
            try {
                $user = Http::timeout(5)->get('https://api.github.com/users/konkazazis')->throw()->json();

                return [
                    'url'       => 'https://github.com/konkazazis',
                    'repos'     => $user['public_repos'] ?? count($repos),
                    'followers' => $user['followers'] ?? 0,
                    'stars'     => collect($repos)->sum('stargazers_count'),
                ];
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch GitHub user: '.$e->getMessage());

                return null;
            }
        });
    }

    private function summarizeCodeberg(array $repos): ?array
    {
        if (empty($repos)) {
            return null;
        }

        return Cache::remember('dev-stats:codeberg:summary', now()->addHours(6), function () use ($repos) {
            try {
                $user = Http::timeout(5)->get('https://codeberg.org/api/v1/users/konkazazis')->throw()->json();

                return [
                    'url'       => 'https://codeberg.org/konkazazis',
                    'repos'     => count($repos),
                    'followers' => $user['followers_count'] ?? 0,
                    'stars'     => collect($repos)->sum('stars_count'),
                ];
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch Codeberg user: '.$e->getMessage());

                return null;
            }
        });
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <section class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
            <div class="max-w-2xl mx-auto text-center text-stone-400 text-sm">
                Loading stats…
            </div>
        </section>
        HTML;
    }

    public function render()
    {
        return view('livewire.dev-stats');
    }
}
