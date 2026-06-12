@props(['projects'])

<section id="portfolio" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
    <div class="max-w-6xl mx-auto">
        <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
            Portfolio
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($projects as $project)
                <div class="group relative overflow-hidden bg-stone-100 aspect-square">
                    @if($project->coverUrl())
                        <img src="{{ $project->coverUrl() }}"
                            alt="{{ $project->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    @endif
                    <a href="{{ $project->live_url ?? '#' }}"
                        @if($project->live_url) target="_blank" rel="noopener noreferrer" @endif
                        class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-lg font-bold text-white text-center">{{ $project->title }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
