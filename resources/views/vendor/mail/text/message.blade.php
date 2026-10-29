<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.brand_name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy>
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            {{ config('app.brand_name') }} · Custom websites and CMS for freelancers and small businesses.
            See my work: {{ route('work') }}
            © {{ date('Y') }} Konstantinos Kazazis · {{ route('impressum') }}
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
