<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ config('app.brand_name') }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
Custom websites and CMS for freelancers and small businesses.<br>
Based in Düsseldorf, working worldwide.

[Work]({{ route('work') }}) &nbsp;·&nbsp; [Website finder]({{ route('website-finder') }}) &nbsp;·&nbsp; [kostas@kazazis.dev](mailto:kostas@kazazis.dev)

© {{ date('Y') }} Konstantinos Kazazis &nbsp;·&nbsp; [Impressum]({{ route('impressum') }}) &nbsp;·&nbsp; [Privacy]({{ route('privacy') }})
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
