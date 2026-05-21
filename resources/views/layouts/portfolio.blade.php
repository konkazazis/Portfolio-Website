@extends('layouts.master')

@section('title', 'Portfolio')

@section('content')

    <!-- START HOME -->
    <section id="home" class="pt-40 pb-32 px-6 sm:px-8 bg-white">
        <div class="max-w-3xl mx-auto flex lg:gap-12">

            <div class="pb-12">
                <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic.png" alt="Kostas Kazazis"
                    class="w-48 h-48 rounded-none mx-auto mb-10 object-cover border border-stone-300" />

                <div class="flex justify-center gap-8 mb-12">
                    <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer" aria-label="GitHub"
                        class="text-stone-600 hover:text-stone-900 transition text-xl">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/Kostas-kazazis-32a470228/" target="_blank"
                        rel="noopener noreferrer" aria-label="LinkedIn"
                        class="text-stone-600 hover:text-stone-900 transition text-xl">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="{{ route('blog') }}" aria-label="Blog"
                        class="text-stone-600 hover:text-stone-900 transition text-xl">
                        <i class="fa fa-pencil"></i>
                    </a>
                </div>

                <div class="text-center">
                    <a href="#work"
                        class="inline-block text-sm font-medium text-stone-900 border border-stone-400 px-6 py-2 hover:bg-stone-50 transition smoothScroll tracking-wide">
                        EXPLORE WORK
                    </a>
                </div>
            </div>

            <div class="text-center pb-12">
                <h1 class="font-serif text-6xl md:text-7xl font-bold text-stone-900 mb-6 leading-tight">
                    Kostas Kazazis
                </h1>
                <p class="font-serif text-2xl md:text-3xl text-stone-700 mb-8 font-light">
                    Full-Stack Web Developer
                </p>
                <p class="text-lg text-stone-600 leading-relaxed mb-8 font-light">
                    Crafting elegant digital experiences for the web. Based in Düsseldorf.
                </p>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    <!-- START WORK -->
    <section id="work" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                Services
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="border-l-2 border-stone-400 pl-6">
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-4">Professional Websites</h3>
                    <p class="text-stone-600 leading-relaxed font-light">
                        Beautiful and custom websites that convert. With features like custom blogs and contact sections.
                    </p>
                </div>

                <div class="border-l-2 border-stone-400 pl-6">
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-4">Mobile-Friendly Design</h3>
                    <p class="text-stone-600 leading-relaxed font-light">
                        Your website works perfectly on phones, tablets, and computers—reaching customers everywhere.
                    </p>
                </div>

                <div class="border-l-2 border-stone-400 pl-6">
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-4">Secure & Protected</h3>
                    <p class="text-stone-600 leading-relaxed font-light">
                        Keep your business and customer data safe with professional security measures.
                    </p>
                </div>
            </div>

            <div class="text-center mt-16">
                <a href="#contact"
                    class="inline-block text-sm font-medium text-stone-900 border border-stone-400 px-6 py-2 hover:bg-stone-50 transition smoothScroll tracking-wide">
                    GET STARTED
                </a>
            </div>
        </div>
    </section>
    <!-- END WORK -->

    <!-- START PRICING -->
    <section id="pricing" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                Pricing
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Pricing 1 -->
                <div class="border border-stone-400 p-10">
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-2">Custom Web Apps</h3>
                    <p class="text-stone-600 text-lg font-light mb-8">Contact for pricing</p>
                    <ul class="space-y-3 text-stone-700">
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Blogs, SASS, and more</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Full-stack development</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Database design</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>User authentication</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Payment integration</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Admin dashboard</span>
                        </li>
                    </ul>
                    <a href="#contact"
                        class="inline-block mt-10 text-sm font-medium text-stone-900 border border-stone-400 px-6 py-2 hover:bg-stone-50 transition smoothScroll tracking-wide">
                        INQUIRE
                    </a>
                </div>

                <!-- Pricing 2 -->
                <div class="border-2 border-stone-900 p-10">
                    <div class="mb-8 pb-6 border-b-2 border-stone-300">
                        <p class="text-xs font-medium text-stone-600 uppercase tracking-widest mb-2">Most Popular</p>
                        <h3 class="font-serif text-2xl font-bold text-stone-900">Landing Page</h3>
                    </div>
                    <p class="text-stone-600 text-lg font-light mb-8">Contact for pricing</p>
                    <ul class="space-y-3 text-stone-700">
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>5 pages included</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Custom design</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Responsive layout</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>SEO optimization</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Contact forms</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-stone-400 mr-3">•</span>
                            <span>Excellent performance</span>
                        </li>
                    </ul>
                    <a href="#contact"
                        class="inline-block mt-10 text-sm font-medium text-white bg-stone-900 px-6 py-2 hover:bg-stone-800 transition smoothScroll tracking-wide">
                        INQUIRE
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END PRICING -->

    <!-- START TESTIMONIALS -->
    <section id="testimonials" class="py-24 px-6 sm:px-8 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                Testimonials
            </h2>

            <div class="space-y-16">
                <!-- Testimonial 1 -->
                <div class="border-l-4 border-stone-400 pl-8">
                    <p class="font-serif text-2xl italic text-stone-700 mb-6 leading-relaxed">
                        "Kostas created an amazing website for my small business. The process was smooth, and the result
                        exceeded my expectations."
                    </p>
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-serif font-bold text-stone-900">Sarah M.</h5>
                            <span class="text-sm text-stone-600">Small Business Owner</span>
                        </div>
                        <div class="flex gap-1">
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="border-l-4 border-stone-400 pl-8">
                    <p class="font-serif text-2xl italic text-stone-700 mb-6 leading-relaxed">
                        "Professional, responsive, and delivered on time. Kostas helped me get my online store up and
                        running quickly."
                    </p>
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-serif font-bold text-stone-900">Kostas Kapratsis</h5>
                            <span class="text-sm text-stone-600">Fitness Coach</span>
                        </div>
                        <div class="flex gap-1">
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="border-l-4 border-stone-400 pl-8">
                    <p class="font-serif text-2xl italic text-stone-700 mb-6 leading-relaxed">
                        "Working with Kostas was a great experience. He understood my vision and brought it to life. The
                        website looks professional and has helped grow my business significantly."
                    </p>
                    <div class="flex items-center justify-between">
                        <div>
                            <h5 class="font-serif font-bold text-stone-900">Christos Karpos</h5>
                            <span class="text-sm text-stone-600">Industrial Designer</span>
                        </div>
                        <div class="flex gap-1">
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                            <i class="fa fa-star text-stone-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TESTIMONIALS -->

    <!-- START PORTFOLIO -->
    <section id="portfolio" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                Portfolio
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Portfolio Item 1 -->
                <div class="group relative overflow-hidden bg-stone-100 aspect-square">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/ntinos.png" alt="Personal Training Platform"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    <a href="https://kostas-eshop-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-lg font-bold text-white text-center">Personal Training</h3>
                    </a>
                </div>

                <!-- Portfolio Item 2 -->
                <div class="group relative overflow-hidden bg-stone-100 aspect-square">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/karpos.png" alt="Freelancer Landing Page"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    <a href="https://chris-karpos-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-lg font-bold text-white text-center">Designer Portfolio</h3>
                    </a>
                </div>

                <!-- Portfolio Item 3 -->
                <div class="group relative overflow-hidden bg-stone-100 aspect-square">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/car-blog.png" alt="Car news site"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    <a href="https://car-blog-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-lg font-bold text-white text-center">Car Blog</h3>
                    </a>
                </div>

                <!-- Portfolio Item 4 -->
                <div class="group relative overflow-hidden bg-stone-100 aspect-square">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/kostas-photography.png"
                        alt="Photographer Portfolio"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    <a href="https://car-blog-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-lg font-bold text-white text-center">Photography</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END PORTFOLIO -->


    <!-- START BLOG -->
    @if($posts->isNotEmpty())
        <section id="blog" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
            <div class="max-w-5xl mx-auto">
                <h2 class=" font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                    Latest Essays
                </h2>

                <div class="space-y-12 mb-16">
                    @foreach($posts->take(3) as $post)
                        <article class="border-b border-stone-300 pb-12">
                            @if($post->category)
                                <span class="text-xs font-medium text-stone-600 uppercase tracking-widest">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            <h3 class="font-serif text-3xl font-bold text-stone-900 my-3 hover:text-stone-700 transition">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            @if($post->excerpt)
                                <p class="text-stone-600 leading-relaxed font-light mb-4">{!! Str::limit($post->excerpt, 150) !!}</p>
                            @endif
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="text-sm font-medium text-stone-900 border-b border-stone-400 hover:border-stone-900 transition">
                                Read More
                            </a>
                        </article>
                    @endforeach

                </div>

                <div class="text-center">
                    <a href="{{ route('blog') }}"
                        class="inline-block text-sm font-medium text-stone-900 border border-stone-400 px-6 py-2 hover:bg-stone-50 transition tracking-wide">
                        VIEW ALL ESSAYS
                    </a>
                </div>
            </div>
        </section>
    @endif
    <!-- END BLOG -->

    <!-- START TECHNOLOGIES -->
    <section id="technologies" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
        <div class="max-w-2xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
                Technologies
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-12 justify-items-center">
                <div class="flex flex-col items-center text-center">
                    <i class="fa-brands fa-wordpress colored text-5xl mb-4"></i>
                    <span class="font-serif font-bold text-stone-900 text-sm">Wordpress</span>
                </div>
                <div class="flex flex-col items-center text-center">
                    <i class="fa-brands fa-laravel colored text-5xl mb-4"></i>
                    <span class="font-serif font-bold text-stone-900 text-sm">Laravel</span>
                </div>
                <div class="flex flex-col items-center text-center">
                    <i class="fa-brands fa-react colored text-5xl mb-4"></i>
                    <span class="font-serif font-bold text-stone-900 text-sm">React</span>
                </div>
            </div>
        </div>
    </section>
    <!-- END TECHNOLOGIES -->

    <!-- START ABOUT -->
    <section id="about" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-12 items-center">
                <div class="md:col-span-3">
                    <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-6">
                        About
                    </h2>
                    <p class="font-serif text-xl text-stone-700 mb-8 font-light">
                        Full-Stack Web Developer based in Düsseldorf, Germany.
                    </p>
                    <p class="text-stone-600 leading-relaxed mb-6 font-light">
                        I specialize in building scalable, user-centric web applications. With a strong foundation in modern
                        web technologies and a keen eye for detail, I transform ideas into elegant digital solutions.
                    </p>
                    <p class="text-stone-600 leading-relaxed font-light">
                        My approach combines technical excellence with creative problem-solving. Whether you're launching a
                        new web presence or enhancing an existing platform, I'm here to deliver exceptional results.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic-nobg.png" alt="Kostas Kazazis"
                        class="w-full max-w-xs mx-auto" />
                </div>
            </div>
        </div>
    </section>
    <!-- END ABOUT -->

    <!-- START CONTACT -->
    <section id="contact" class="py-24 px-6 sm:px-8 bg-stone-900 text-white border-t border-stone-800">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold mb-2 text-center">
                Get in Touch
            </h2>
            <p class="mb-12 text-stone-400 text-center">kostas@kazazis.dev</p>
            <form id="contact-form" class="space-y-6 mb-12" action="https://formsubmit.co/kostas@kazazis.dev" method="POST">
                @csrf
                <input type="hidden" name="_subject" value="New Contact Form Submission from Portfolio" />
                <input type="hidden" name="_captcha" value="false" />
                <input type="hidden" name="_next" value="" />
                <input type="hidden" name="_template" value="box" />
                <input type="hidden" name="_autoresponse" value="Thank you for contacting me! I'll get back to you soon." />
                <input type="text" name="_honey" id="hp-website" autocomplete="off" tabindex="-1"
                    style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;opacity:0;" aria-hidden="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input
                        class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white placeholder-stone-500 focus:outline-none focus:border-white transition"
                        type="text" name="name" id="name" placeholder="Name" required />
                    <input
                        class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white placeholder-stone-500 focus:outline-none focus:border-white transition"
                        type="email" name="email" id="email" placeholder="Email" required />
                </div>

                <input
                    class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white placeholder-stone-500 focus:outline-none focus:border-white transition"
                    type="text" name="subject" id="subject" placeholder="Subject" required />

                <textarea
                    class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white placeholder-stone-500 focus:outline-none focus:border-white transition resize-none"
                    name="message" id="message" placeholder="Message" rows="6" required></textarea>

                <button type="submit"
                    class="w-full py-3 bg-white text-stone-900 font-semibold hover:bg-stone-100 transition">
                    Send
                </button>
            </form>

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
                        Datenschutz
                    </a>
                </div>
            </div>


        </div>
        </div>
    </section>
    <!-- END CONTACT -->

    <script>
        // Smooth scroll handling for anchor links
        document.querySelectorAll('a.smoothScroll').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const element = document.querySelector(href);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const navMenu = document.getElementById('nav-menu');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function () {
                navMenu.classList.toggle('hidden');
                navMenu.classList.toggle('flex');
                navMenu.classList.toggle('flex-col');
                navMenu.classList.toggle('absolute');
                navMenu.classList.toggle('top-16');
                navMenu.classList.toggle('left-0');
                navMenu.classList.toggle('right-0');
                navMenu.classList.toggle('bg-white');
                navMenu.classList.toggle('border-b');
            });
        }
    </script>
@endsection