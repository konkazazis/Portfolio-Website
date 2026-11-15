<x-mail::message>
# {{ $name ? 'Hi '.$name.',' : 'Hi there,' }}

Here's the homepage you designed for **{{ $businessName }}**. Open it any time, or send the link to someone for a second opinion.

<x-mail::button :url="$homepageUrl" color="success">
Open your homepage
</x-mail::button>

## Want it online?

I can build it properly, with your own text, photos and domain, and put it live.

@if ($projects->isNotEmpty())
Here are a few sites I've built, each with a short case study:

<x-mail::panel>
@foreach ($projects as $project)
**[{{ $project->title }}]({{ route('work.show', $project->slug) }})**{{ $project->description ? ' — '.Str::limit($project->description, 110) : '' }}


@endforeach
</x-mail::panel>
@endif

<x-mail::button :url="route('work')">
See my work
</x-mail::button>

{!! $bookingUrl ? '[Book a free 20-minute call]('.e($bookingUrl).') or reply' : 'Reply' !!} to this email and tell me a bit about your business. I read every message myself.

Talk soon,<br>
Kostas
</x-mail::message>
