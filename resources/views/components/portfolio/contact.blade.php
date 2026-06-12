<section id="contact" class="py-24 px-6 sm:px-8 bg-stone-900 text-white border-t border-stone-800">
    <div class="max-w-3xl mx-auto">
        <h2 class="font-serif text-5xl md:text-6xl font-bold mb-2 text-center">
            Get in Touch
        </h2>
        <p class="mb-12 text-stone-400 text-center">kostas@kazazis.dev</p>

        <livewire:contact-form />

        <div class="lg:flex text-center lg:justify-between border-t border-stone-800 pt-8 text-stone-400 text-sm">
            <div class="mb-4 lg:mb-0">
                <p>Copyright © {{ date('Y') }} Kostas Kazazis</p>
            </div>
            <div class="flex justify-between lg:gap-4">
                <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer"
                    class="text-sm text-zinc-500 hover:text-brand transition-colors">
                    GitHub
                </a>
                <a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank"
                    rel="noopener noreferrer" class="text-sm text-zinc-500 hover:text-brand transition-colors">
                    LinkedIn
                </a>
                <a href="{{ route('impressum') }}" class="text-sm text-zinc-500 hover:text-brand transition-colors">
                    Impressum
                </a>
                <a href="{{ route('privacy') }}" class="text-sm text-zinc-500 hover:text-brand transition-colors">
                    Privacy
                </a>
            </div>
        </div>
    </div>
</section>
