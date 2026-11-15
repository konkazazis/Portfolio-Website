<x-mail::message>
# {{ $name ? 'Hi '.$name.',' : 'Hi there,' }}

Thanks for going through the website finder. From your answers, you're after {!! $recap !!}.

## Your free homepage

Here's the homepage built from your answers. It's a single file: open it in your browser, swap in your own text and photos, and upload it anywhere.

<x-mail::button :url="$homepageUrl" color="success">
Download your homepage
</x-mail::button>

@if ($projects->isNotEmpty())
## Curious what that could look like?

Here are a few sites I've built, each with a short case study.

<x-mail::panel>
@foreach ($projects as $project)
**[{{ $project->title }}]({{ route('work.show', $project->slug) }})**{{ $project->description ? ' — '.Str::limit($project->description, 110) : '' }}


@endforeach
</x-mail::panel>
@else
## Curious what that could look like?

Have a look at sites I've built for other clients.
@endif

<x-mail::button :url="route('work')">
See my work
</x-mail::button>

If you'd like it built for real, {!! $bookingUrl ? '[book a free 20-minute call]('.e($bookingUrl).') or' : '' !!} reply to this email and tell me a bit more. I read every message myself.

Talk soon,<br>
Kostas
</x-mail::message>
