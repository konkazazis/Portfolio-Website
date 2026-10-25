@php
    $packages = [
        [
            'name' => 'Website / Web App',
            'tagline' => 'Everything you need to launch, built from scratch.',
            'dark' => false,
            'features' => [
                'Custom-made, secure Laravel-based website or application',
                'Custom-made CMS to manage your own content',
                'Lightning-fast, app-like load times',
                'Google Lighthouse score of 100 across the board',
                'On-point technical SEO',
                'Mobile-friendly design',
                'Domain purchase with SSL',
                'Hosting and business email setup',
            ],
        ],
        [
            'name' => 'Care Package',
            'tagline' => 'Ongoing peace of mind after launch.',
            'dark' => true,
            'features' => [
                'Hosting',
                'Database backups',
                '1 hour of edits included every month',
                'Software and security updates',
                'Weekly uptime checks',
                'SEO and performance monitoring',
            ],
        ],
    ];
@endphp

<section id="pricing" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-200">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-16">
            <span class="section-label">Packages</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900">Simple, honest pricing</h2>
            <p class="mt-5 text-lg text-stone-600 font-light max-w-2xl mx-auto">
                Every project is different, so every quote is tailored. You get a fixed price up front, no hidden costs.
            </p>
            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="mt-6 inline-flex items-center gap-2 rounded-full border-2 border-[#1C1B22] bg-[#8EE3C8] px-5 py-2 text-sm font-semibold text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i> Which package fits me? Take the 2-minute quiz
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach($packages as $i => $package)
                <div class="flex flex-col rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] p-9 shadow-[7px_7px_0_#1C1B22] reveal transition-transform duration-300 hover:-translate-y-1 {{ $package['dark'] ? 'bg-stone-900 text-white reveal-delay-1' : 'bg-white text-stone-900' }}">
                    <h3 class="font-serif text-3xl font-bold {{ $package['dark'] ? 'text-white' : 'text-stone-900' }}">{{ $package['name'] }}</h3>
                    <p class="mt-2 font-light {{ $package['dark'] ? 'text-stone-300' : 'text-stone-600' }}">{{ $package['tagline'] }}</p>

                    <p class="mt-6 pb-6 border-b {{ $package['dark'] ? 'border-stone-700 text-stone-400' : 'border-stone-200 text-stone-500' }} text-sm uppercase tracking-[0.2em]">
                        Price on request
                    </p>

                    <ul class="mt-6 mb-10 space-y-3">
                        @foreach($package['features'] as $feature)
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check mt-1.5 text-sm {{ $package['dark'] ? 'text-[#FFE45C]' : 'text-brand' }}" aria-hidden="true"></i>
                                <span class="{{ $package['dark'] ? 'text-stone-200' : 'text-stone-700' }}">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('contact') }}"
                       class="mt-auto self-start inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] px-6 py-2.5 text-sm font-semibold tracking-wide transition-transform hover:-translate-y-0.5 {{ $package['dark'] ? 'border-white bg-[#FFE45C] text-[#1C1B22] shadow-[4px_4px_0_#fff]' : 'border-[#1C1B22] bg-white text-[#1C1B22] shadow-[4px_4px_0_#1C1B22]' }}">
                        GET A QUOTE <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
