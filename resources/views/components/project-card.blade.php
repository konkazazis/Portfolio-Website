@props(['project', 'index' => 0])

@php
    $placeholderColors = ['#FFE45C', '#8EE3C8', '#FF9EC7', '#C7B8FF'];
@endphp

<article {{ $attributes->merge(['class' => 'group']) }}>
    <a href="{{ route('work.show', $project->slug) }}" class="block">
        <div class="relative aspect-[16/11] overflow-hidden rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-stone-100 shadow-[7px_7px_0_#1C1B22] transition-transform duration-300 group-hover:-translate-y-1">
            @if($project->coverUrl())
                <img src="{{ $project->coverUrl() }}" alt="{{ $project->title }}" loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.035]">
            @else
                <div class="w-full h-full flex items-center justify-center p-8 transition-transform duration-700 ease-out group-hover:scale-[1.035]"
                     style="background-color: {{ $placeholderColors[$index % count($placeholderColors)] }}">
                    <span class="font-serif text-3xl md:text-4xl text-center leading-tight text-[#1C1B22] -rotate-2">{{ $project->title }}</span>
                </div>
            @endif
            <span class="absolute top-3.5 right-3.5 bg-white/90 border border-stone-200 rounded-full px-3 py-1.5 font-mono text-[11.5px] tracking-[0.04em] inline-flex items-center gap-1.5 backdrop-blur opacity-0 -translate-y-1.5 transition group-hover:opacity-100 group-hover:translate-y-0">Case study <span>&rarr;</span></span>
        </div>

        <div class="mt-7">
            @if($project->client || $project->year)
                <div class="flex items-center gap-3 text-xs uppercase tracking-[0.25em] text-stone-500">
                    @if($project->client)<span>{{ $project->client }}</span>@endif
                    @if($project->client && $project->year)<span aria-hidden="true">·</span>@endif
                    @if($project->year)<span>{{ $project->year }}</span>@endif
                </div>
            @endif
            <h3 class="mt-2 font-serif text-3xl font-bold text-stone-900 leading-tight">{{ $project->title }}</h3>
            @if($project->description)
                <p class="mt-3 text-stone-600 font-light leading-relaxed max-w-[48ch]">{{ $project->description }}</p>
            @endif
            @if($project->techList())
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($project->techList() as $tech)
                        <span class="tag-badge">{{ $tech }}</span>
                    @endforeach
                </div>
            @endif
            <span class="inline-flex items-center gap-2 mt-5 font-semibold text-sm text-stone-900 border-b-[1.5px] border-stone-300 pb-0.5 transition-all group-hover:border-brand group-hover:gap-3">
                Read case study <span class="text-brand">&rarr;</span>
            </span>
        </div>
    </a>
</article>
