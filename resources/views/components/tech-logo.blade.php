@props(['slug', 'label', 'color', 'delay' => 0, 'size' => 'size-9 sm:size-12'])

<div class="tech-float group" title="{{ $label }}" style="animation-delay: -{{ $delay * 0.7 }}s">
    <span class="tech-logo {{ $size }} transition-transform duration-300 group-hover:scale-110" style="color: {{ $color }}">
        {!! file_get_contents(resource_path("svg/tech/{$slug}.svg")) !!}
    </span>
</div>
