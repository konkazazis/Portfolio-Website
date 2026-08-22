<section id="dev-stats" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
    <div class="max-w-2xl mx-auto">
        <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
            Latest software projects
        </h2>

        <div class="grid sm:grid-cols-2 gap-8">
            @if($github)
                <a href="{{ $github['url'] }}" target="_blank" rel="noopener noreferrer"
                   class="block border border-stone-300 rounded-lg p-8 text-center hover:border-stone-900 transition-colors">
                    <i class="fa-brands fa-github text-4xl text-stone-900 mb-4"></i>
                    <p class="font-bold text-stone-900 mb-6">GitHub</p>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $github['repos'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Repos</p>
                        </div>
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $github['followers'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Followers</p>
                        </div>
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $github['stars'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Stars</p>
                        </div>
                    </div>
                </a>
            @endif

            @if($codeberg)
                <a href="{{ $codeberg['url'] }}" target="_blank" rel="noopener noreferrer"
                   class="block border border-stone-300 rounded-lg p-8 text-center hover:border-stone-900 transition-colors">
                    <i class="fa-solid fa-code-branch text-4xl text-stone-900 mb-4"></i>
                    <p class="font-bold text-stone-900 mb-6">Codeberg</p>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $codeberg['repos'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Repos</p>
                        </div>
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $codeberg['followers'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Followers</p>
                        </div>
                        <div>
                            <p class="font-bold text-2xl text-stone-900">{{ $codeberg['stars'] }}</p>
                            <p class="text-xs text-stone-500 uppercase tracking-wide">Stars</p>
                        </div>
                    </div>
                </a>
            @endif

            @if(!$github && !$codeberg)
                <p class="col-span-2 text-center text-stone-400 text-sm">Stats are unavailable right now.</p>
            @endif
        </div>

        @if(!empty($latestRepos))
            <div class="mt-16">
                <div class="divide-y divide-stone-200 border-t border-b border-stone-200">
                    @foreach($latestRepos as $repo)
                        <a href="{{ $repo['url'] }}" target="_blank" rel="noopener noreferrer"
                           class="flex items-center justify-between gap-4 py-4 hover:bg-stone-50 transition-colors px-2 -mx-2">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <i class="{{ $repo['platform'] === 'GitHub' ? 'fa-brands fa-github' : 'fa-solid fa-code-branch' }} text-stone-400 text-xs"></i>
                                    <span class="font-semibold text-stone-900 truncate">{{ $repo['name'] }}</span>
                                    @if($repo['language'])
                                        <span class="text-xs text-stone-400">{{ $repo['language'] }}</span>
                                    @endif
                                </div>
                                @if($repo['description'])
                                    <p class="text-sm text-stone-500 truncate mt-0.5">{{ $repo['description'] }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 shrink-0 text-xs text-stone-400">
                                @if($repo['stars'] > 0)
                                    <span><i class="fa-solid fa-star"></i> {{ $repo['stars'] }}</span>
                                @endif
                                <span>{{ $repo['pushed_at']->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
