<section id="home" class="pt-26 pb-32 px-6 sm:px-8 bg-white">
    <div class="max-w-3xl mx-auto flex flex-col lg:flex-row lg:gap-12">
        <div class="flex-col justify-between reveal">
            <h1 class="font-serif text-6xl md:text-7xl font-bold text-stone-900 mb-6 leading-tight">Kostas Kazazis</h1>
            <p class="text-2xl md:text-3xl text-stone-700 mb-4 font-light">Full-Stack Web Developer</p>
            <p class="text-lg text-stone-600 leading-relaxed mb-8 font-light">
                Every freelancer needs a website. Crafting clean, reliable and custom sites that get your name out
                there. My support, in your journey. Based in Düsseldorf.
            </p>
        </div>

        <div class="pb-12 flex-shrink-0 reveal reveal-delay-2">
            <div class="relative mx-auto mb-10 flex w-fit items-center justify-center">
                <img src="{{ asset('images/blob.svg') }}" alt="" aria-hidden="true"
                    class="absolute w-[125%] max-w-none rotate-12" />
                <img src="https://images.kazazis.dev/profile-pic.png" alt="Kostas Kazazis" class="relative w-56 h-56 sm:w-72 sm:h-72 lg:w-82 lg:h-82 rounded-full object-cover
                        bg-white border-4 border-[#1C1B22]
                        rotate-[4deg] shadow-[7px_7px_0_#1C1B22] sm:shadow-[10px_10px_0_#1C1B22]
                        transition-transform duration-500 hover:scale-105 hover:rotate-0" />
            </div>

            <div class="flex justify-center gap-8 mb-12">
                <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer" aria-label="GitHub"
                    class="text-stone-600 hover:text-stone-900 transition text-xl">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank"
                    rel="noopener noreferrer" aria-label="LinkedIn"
                    class="text-stone-600 hover:text-stone-900 transition text-xl">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="{{ route("home") }}" aria-label="Home"
                    class="text-stone-600 hover:text-stone-900 transition text-xl">
                    <i class="fa fa-pencil"></i>
                </a>
            </div>

            <div class="text-center">
                <a href="#work"
                    class="smoothScroll group relative inline-block px-10 py-4 text-sm font-medium tracking-wide text-stone-900">
                    <svg class="absolute inset-0 h-full w-full" viewBox="-4 -4 236.202 68.763"
                        preserveAspectRatio="none" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.4185791015625,0L182.46749877929688,4.662353515625C207.77005004882812,5.324951171875,228.24594116210938,7.2315673828125,228.20175170898438,8.921142578125L228.04177856445312,15.029052734375C227.37924194335938,40.33154296875,225.47256469726562,60.807373046875,223.78317260742188,60.76318359375L51.84210205078125,56.2607421875C23.166259765625,55.509765625,-0.04425048828125,53.5316162109375,0,51.842041015625L0,51.842041015625C0.360595703125,38.071533203125,1.0286865234375,24.873291015625,1.857330322265625,15.151123046875C2.686004638671875,5.4288330078125,3.6072998046875,-0.021240234375,4.4185791015625,0Z"
                            fill="#fff" stroke="#1C1B22" stroke-width="3" stroke-dasharray="7 5"
                            vector-effect="non-scaling-stroke" class="transition group-hover:fill-stone-50" />
                    </svg>

                    <span class="relative inline-block rotate-[2.3deg] translate-y-px">EXPLORE WORK</span>
                </a>
            </div>
        </div>
    </div>
</section>