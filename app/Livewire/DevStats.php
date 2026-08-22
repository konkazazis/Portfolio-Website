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
        $github = $this->fetchGithub();
        $codeberg = $this->fetchCodeberg();

        $this->github = $github['summary'] ?? null;
        $this->codeberg = $codeberg['summary'] ?? null;
        $this->latestRepos = $this->buildLatestRepos($github['repos'] ?? [], $codeberg['repos'] ?? []);
    }

    private function fetchGithub(): ?array
    {
        return Cache::remember('dev-stats:github:v2', now()->addHours(6), function () {
            try {
                $user = Http::timeout(5)->get('https://api.github.com/users/konkazazis')->throw()->json();
                $repos = Http::timeout(5)
                    ->get('https://api.github.com/users/konkazazis/repos', ['per_page' => 100])
                    ->throw()
                    ->json();

                if (! isset($user['login']) || empty($repos)) {
                    throw new \RuntimeException('Unexpected GitHub API response shape.');
                }

                return [
                    'repos'   => $repos,
                    'summary' => [
                        'url'       => 'https://github.com/konkazazis',
                        'repos'     => count($repos),
                        'followers' => $user['followers'] ?? 0,
                        'stars'     => collect($repos)->sum('stargazers_count'),
                    ],
                ];
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch GitHub stats: '.$e->getMessage());

                return null;
            }
        });
    }

    private function fetchCodeberg(): ?array
    {
        return Cache::remember('dev-stats:codeberg:v2', now()->addHours(6), function () {
            try {
                $user = Http::timeout(5)->get('https://codeberg.org/api/v1/users/konkazazis')->throw()->json();
                $repos = Http::timeout(5)
                    ->get('https://codeberg.org/api/v1/users/konkazazis/repos', ['limit' => 50])
                    ->throw()
                    ->json();

                if (! isset($user['login']) || empty($repos)) {
                    throw new \RuntimeException('Unexpected Codeberg API response shape.');
                }

                return [
                    'repos'   => $repos,
                    'summary' => [
                        'url'       => 'https://codeberg.org/konkazazis',
                        'repos'     => count($repos),
                        'followers' => $user['followers_count'] ?? 0,
                        'stars'     => collect($repos)->sum('stars_count'),
                    ],
                ];
            } catch (\Throwable $e) {
                Log::warning('Failed to fetch Codeberg stats: '.$e->getMessage());

                return null;
            }
        });
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
