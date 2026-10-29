<x-mail::message>
# {{ $name ? 'Hi '.$name.',' : 'Hi there,' }}

Thanks for taking the time to go through the website finder. Your answers landed safely in my inbox, and I've already had a read.

So, from what you told me: you're after {!! $recap !!}. Honestly, that's my favourite kind of project to work on.

@if ($projects->isNotEmpty())
## Curious what that could look like?

The best way to get a feel for how I work is to see what I've built for others. Each project comes with a short case study: what the client needed, how I approached it, and what changed once it went live.

<x-mail::panel>
@foreach ($projects as $project)
**[{{ $project->title }}]({{ route('work.show', $project->slug) }})**{{ $project->description ? ' — '.Str::limit($project->description, 110) : '' }}


@endforeach
</x-mail::panel>
@else
## Curious what that could look like?

Have a look around my work. Each project shows what the client needed, how I approached it, and what changed once it went live.
@endif

<x-mail::button :url="route('work')">
See my work
</x-mail::button>

If something there sparks an idea, {!! $bookingUrl ? '[grab a free 20-minute call]('.e($bookingUrl).') or simply' : 'simply' !!} hit reply and tell me a bit more. I read every message myself, and I'll come back with a few ideas shaped around your project.

Talk soon,<br>
Kostas
</x-mail::message>
