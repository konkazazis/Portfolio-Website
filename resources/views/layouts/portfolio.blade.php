@extends('layouts.master')

@section('title', 'Portfolio')

@section('content')

    <!-- START NAVIGATION -->
    <nav class="fixed top-0 w-full bg-stone-50/95 backdrop-blur-sm border-b border-stone-200 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#home" class="font-serif text-2xl font-bold text-[#eb5424] smoothScroll">KK</a>
                <button id="mobile-menu-btn" class="md:hidden text-stone-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
                <ul id="nav-menu" class="hidden md:flex gap-8 text-sm font-medium text-stone-700">
                    <li><a href="#home" class="hover:text-[#eb5424] transition smoothScroll">Home</a></li>
                    <li><a href="#work" class="hover:text-[#eb5424] transition smoothScroll">Services</a></li>
                    <li><a href="#pricing" class="hover:text-[#eb5424] transition smoothScroll">Pricing</a></li>
                    <li><a href="#portfolio" class="hover:text-[#eb5424] transition smoothScroll">Portfolio</a></li>
                    <li><a href="#blog" class="hover:text-[#eb5424] transition smoothScroll">Blog</a></li>
                    <li><a href="#about" class="hover:text-[#eb5424] transition smoothScroll">About</a></li>
                    <li><a href="#contact" class="hover:text-[#eb5424] transition smoothScroll">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVIGATION -->


    <!-- START HOME -->
    <section id="home" class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-stone-50 via-stone-50 to-[#eb5424]/5">
        <div class="max-w-4xl mx-auto text-center">
            <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic.png"
                alt="Kostas Kazazis - Full-Stack Web Developer in Düsseldorf, Germany"
                class="w-32 h-32 rounded-full mx-auto mb-8 border-4 border-[#eb5424] shadow-lg object-cover" />
            <h1 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-4">Kostas Kazazis</h1>
            <p class="text-xl md:text-2xl text-[#eb5424] font-medium mb-6">Full-Stack Web Developer</p>
            <p class="text-lg text-stone-700 mb-8 leading-relaxed">I craft beautiful, responsive websites and web
                applications that convert. Based in Düsseldorf, Germany, I help businesses establish a powerful online
                presence.</p>

            <!-- Social Links -->
            <div class="flex justify-center gap-6 mb-10">
                <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer"
                    class="w-12 h-12 rounded-full bg-[#eb5424] text-white flex items-center justify-center hover:bg-[#c94219] transition transform hover:scale-110"
                    aria-label="GitHub">
                    <i class="fa fa-github text-lg"></i>
                </a>
                <a href="https://www.linkedin.com/in/Kostas-kazazis-32a470228/" target="_blank" rel="noopener noreferrer"
                    class="w-12 h-12 rounded-full bg-[#eb5424] text-white flex items-center justify-center hover:bg-[#c94219] transition transform hover:scale-110"
                    aria-label="LinkedIn">
                    <i class="fa fa-linkedin text-lg"></i>
                </a>
                <a href="{{ route('blog') }}"
                    class="w-12 h-12 rounded-full bg-[#eb5424] text-white flex items-center justify-center hover:bg-[#c94219] transition transform hover:scale-110"
                    aria-label="Blog">
                    <i class="fa fa-pencil text-lg"></i>
                </a>
            </div>

            <a href="#work"
                class="inline-block px-8 py-3 bg-[#eb5424] text-white font-semibold rounded-lg hover:bg-[#c94219] transition transform hover:scale-105 smoothScroll">
                Let's Begin
            </a>
        </div>
    </section>
    <!-- END HOME -->

    <!-- START WORK -->
    <section id="work" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                    My <span class="text-[#eb5424]">Services</span>
                </h2>
                <p class="text-stone-600 text-lg">What I offer to help your business thrive online</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Service 1 -->
                <div
                    class="p-8 bg-stone-50 rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition transform hover:scale-105">
                    <div class="w-16 h-16 bg-[#eb5424] rounded-lg flex items-center justify-center mb-6">
                        <i class="fa fa-globe text-white text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-3">Professional Websites</h3>
                    <p class="text-stone-600">Beautiful and custom websites that convert. With features like custom blogs
                        and contact sections.</p>
                </div>

                <!-- Service 2 -->
                <div
                    class="p-8 bg-stone-50 rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition transform hover:scale-105">
                    <div class="w-16 h-16 bg-[#eb5424] rounded-lg flex items-center justify-center mb-6">
                        <i class="fa fa-mobile text-white text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-3">Mobile-Friendly Design</h3>
                    <p class="text-stone-600">Your website works perfectly on phones, tablets, and computers - reaching
                        customers everywhere.</p>
                </div>

                <!-- Service 3 -->
                <div
                    class="p-8 bg-stone-50 rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition transform hover:scale-105">
                    <div class="w-16 h-16 bg-[#eb5424] rounded-lg flex items-center justify-center mb-6">
                        <i class="fa fa-shield text-white text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-stone-900 mb-3">Secure & Protected</h3>
                    <p class="text-stone-600">Keep your business and customer data safe with professional security measures.
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="#contact"
                    class="inline-block px-8 py-3 bg-[#eb5424] text-white font-semibold rounded-lg hover:bg-[#c94219] transition transform hover:scale-105 smoothScroll">
                    Get Started
                </a>
            </div>
        </div>
    </section>
    <!-- END WORK -->

    <!-- START PRICING -->
    <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-stone-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                    Pricing <span class="text-[#eb5424]">Packages</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pricing Card 1 -->
                <div
                    class="bg-white rounded-2xl border-2 border-stone-200 overflow-hidden hover:border-[#eb5424] transition hover:shadow-xl">
                    <div class="p-8 border-b-2 border-stone-100">
                        <div class="w-14 h-14 bg-[#eb5424] rounded-lg flex items-center justify-center mb-4 mx-auto">
                            <i class="fa fa-cogs text-white text-xl"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-center text-stone-900 mb-4">Custom Web Apps</h3>
                        <p class="text-center text-[#eb5424] font-semibold text-lg">Contact for pricing</p>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Blogs, SASS, etc
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Full-stack development
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Database design
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                User authentication
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Payment integration
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Admin (CMS) dashboard
                            </li>
                        </ul>
                        <a href="#contact"
                            class="block w-full text-center px-6 py-3 bg-[#eb5424] text-white font-semibold rounded-lg hover:bg-[#c94219] transition smoothScroll">
                            Get Started
                        </a>
                    </div>
                </div>

                <!-- Pricing Card 2 -->
                <div class="bg-white rounded-2xl border-2 border-[#eb5424] overflow-hidden shadow-xl relative">
                    <div
                        class="absolute top-0 right-0 bg-[#eb5424] text-white px-4 py-1 text-sm font-semibold rounded-bl-lg">
                        Popular</div>
                    <div class="p-8 border-b-2 border-stone-100">
                        <div class="w-14 h-14 bg-[#eb5424] rounded-lg flex items-center justify-center mb-4 mx-auto">
                            <i class="fa fa-rocket text-white text-xl"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-center text-stone-900 mb-4">Landing Page</h3>
                        <p class="text-center text-[#eb5424] font-semibold text-lg">Contact for pricing</p>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                5 pages included
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Custom design
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Responsive layout
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Technical SEO optimization
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Contact form
                            </li>
                            <li class="flex items-center text-stone-700">
                                <i class="fa fa-check text-[#eb5424] w-5 mr-3"></i>
                                Proven excellent performance
                            </li>
                        </ul>
                        <a href="#contact"
                            class="block w-full text-center px-6 py-3 bg-[#eb5424] text-white font-semibold rounded-lg hover:bg-[#c94219] transition smoothScroll">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PRICING -->

    <!-- START TESTIMONIALS -->
    <section id="testimonials" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                    What <span class="text-[#eb5424]">Clients Say</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-stone-50 rounded-xl p-8 border border-stone-200 hover:shadow-lg transition">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fa fa-quote-left text-[#eb5424] text-2xl"></i>
                    </div>
                    <p class="text-stone-700 text-center mb-6 italic">
                        "Kostas created an amazing website for my small business. The process was smooth, and the result
                        exceeded my expectations. My customers love how easy it is to navigate!"
                    </p>
                    <div class="text-center border-t border-stone-200 pt-4">
                        <div class="flex justify-center gap-1 mb-2">
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                        </div>
                        <h5 class="font-serif font-bold text-stone-900">Sarah M.</h5>
                        <span class="text-sm text-stone-600">Small Business Owner</span>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-stone-50 rounded-xl p-8 border border-stone-200 hover:shadow-lg transition">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fa fa-quote-left text-[#eb5424] text-2xl"></i>
                    </div>
                    <p class="text-stone-700 text-center mb-6 italic">
                        "Professional, responsive, and delivered on time. Kostas helped me get my online store up and
                        running quickly. Highly recommend his services!"
                    </p>
                    <div class="text-center border-t border-stone-200 pt-4">
                        <div class="flex justify-center gap-1 mb-2">
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                        </div>
                        <h5 class="font-serif font-bold text-stone-900">Kostas Kapratsis</h5>
                        <span class="text-sm text-stone-600">Fitness and diet coach</span>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-stone-50 rounded-xl p-8 border border-stone-200 hover:shadow-lg transition">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fa fa-quote-left text-[#eb5424] text-2xl"></i>
                    </div>
                    <p class="text-stone-700 text-center mb-6 italic">
                        "Working with Kostas was a great experience. He understood my vision and brought it to life. The
                        website looks professional and has helped grow my business significantly."
                    </p>
                    <div class="text-center border-t border-stone-200 pt-4">
                        <div class="flex justify-center gap-1 mb-2">
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                            <i class="fa fa-star text-[#eb5424]"></i>
                        </div>
                        <h5 class="font-serif font-bold text-stone-900">Christos Karpos</h5>
                        <span class="text-sm text-stone-600">Local Business Owner</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END TESTIMONIALS -->

    <!-- START PORTFOLIO -->
    <section id="portfolio" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-stone-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                    My <span class="text-[#eb5424]">Portfolio</span>
                </h2>
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Portfolio Item 1 -->
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/ntinos.png" alt="Personal Training Platform"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-300" />
                    <a href="https://kostas-eshop-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-xl font-bold text-white mb-2">Personal Training Platform</h3>
                        <p class="text-stone-200 text-sm">Full stack with ecommerce</p>
                    </a>
                </div>

                <!-- Portfolio Item 2 -->
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/karpos.png" alt="Freelancer Landing Page"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-300" />
                    <a href="https://chris-karpos-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-xl font-bold text-white mb-2">Freelancer Landing Page</h3>
                        <p class="text-stone-200 text-sm">Designer Portfolio</p>
                    </a>
                </div>

                <!-- Portfolio Item 3 -->
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/car-blog.png" alt="Car news site"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-300" />
                    <a href="https://car-blog-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-xl font-bold text-white mb-2">Car News Site</h3>
                        <p class="text-stone-200 text-sm">Custom site in Laravel</p>
                    </a>
                </div>

                <!-- Portfolio Item 4 -->
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/kostas-photography.png"
                        alt="Photographer Portfolio"
                        class="w-full h-64 object-cover group-hover:scale-110 transition duration-300" />
                    <a href="https://car-blog-production.up.railway.app/" target="_blank" rel="noopener noreferrer"
                        class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <h3 class="font-serif text-xl font-bold text-white mb-2">Photographer Portfolio</h3>
                        <p class="text-stone-200 text-sm">HTML & Tailwind</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END PORTFOLIO -->


    <!-- START BLOG -->
    @if($posts->isNotEmpty())
        <section id="blog" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                        Latest <span class="text-[#eb5424]">Blog Posts</span>
                    </h2>
                    <p class="text-stone-600 text-lg">Thoughts on web development, tech, and more</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    @foreach($posts->take(3) as $post)
                        <article
                            class="bg-stone-50 rounded-xl overflow-hidden border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                            @if($post->category)
                                <div class="px-6 pt-6">
                                    <span class="inline-block px-3 py-1 bg-[#eb5424] text-white text-xs font-semibold rounded-full">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="font-serif text-xl font-bold text-stone-900 mb-3 hover:text-[#eb5424] transition">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                @if($post->excerpt)
                                    <p class="text-stone-600 mb-6">{!! Str::limit($post->excerpt, 120) !!}</p>
                                @endif
                                <div class="flex items-center justify-between border-t border-stone-200 pt-4">
                                    <span class="text-sm text-stone-500">
                                        <i class="fa fa-calendar mr-2"></i>
                                        {{ $post->published_at->format('M d, Y') }}
                                    </span>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="text-[#eb5424] font-semibold hover:text-[#c94219] transition">
                                        Read More <i class="fa fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('blog') }}"
                        class="inline-block px-8 py-3 bg-[#eb5424] text-white font-semibold rounded-lg hover:bg-[#c94219] transition transform hover:scale-105">
                        View All Posts
                    </a>
                </div>
            </div>
        </section>
    @endif
    <!-- END BLOG -->

    <!-- START TECHNOLOGIES -->
    <section id="technologies" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-stone-50 to-white">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                    <span class="text-[#eb5424]">Technologies</span> I Use
                </h2>
                <p class="text-stone-600 text-lg">Modern tools and frameworks for building scalable applications</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-php-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">PHP</span>
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-laravel-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">Laravel</span>
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-react-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">React</span>
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-javascript-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">JavaScript</span>
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-tailwindcss-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">Tailwind CSS</span>
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-stone-200 hover:border-[#eb5424] hover:shadow-lg transition">
                    <i class="devicon-mysql-plain colored text-4xl mb-3"></i>
                    <span class="font-semibold text-stone-900">MySQL</span>
                </div>
            </div>
        </div>
    </section>
    <!-- END TECHNOLOGIES -->

    <!-- START ABOUT -->
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left">
                    <h2 class="font-serif text-4xl md:text-5xl font-bold text-stone-900 mb-4">
                        This is <span class="text-[#eb5424]">Me</span>
                    </h2>
                    <p class="font-serif text-2xl font-bold text-stone-800 mb-6">
                        Web<span class="text-[#eb5424]">Developer</span>
                    </p>

                    <div class="flex items-center gap-2 mb-8 md:justify-start justify-center text-stone-700">
                        <i class="fa fa-map-marker text-[#eb5424] text-xl"></i>
                        <span class="font-semibold">Düsseldorf, Germany</span>
                    </div>

                    <p class="text-stone-700 leading-relaxed mb-6">
                        I'm a passionate Full-Stack Web Developer with expertise in building scalable, user-centric web
                        applications. With a strong foundation in modern web technologies and a keen eye for detail, I
                        transform ideas into elegant digital solutions.
                    </p>

                    <p class="text-stone-700 leading-relaxed">
                        My approach combines technical excellence with creative problem-solving—basically, I make computers
                        do cool stuff without breaking anything (most of the time). Whether you're looking to launch a new
                        web presence or need to rescue an existing platform from the digital stone age, I'm here to turn
                        your wildest ideas into reality.
                    </p>
                </div>

                <div class="text-center">
                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic-nobg.png"
                        alt="Kostas Kazazis - Professional Web Developer portrait"
                        class="rounded-xl shadow-2xl mx-auto max-w-md" />
                </div>
            </div>
        </div>
    </section>
    <!-- END ABOUT -->

    <!-- START CONTACT -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-stone-900 to-stone-800 text-white">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-serif text-4xl md:text-5xl font-bold mb-2">
                    Drop <span class="text-[#eb5424]">me a line</span>
                </h2>
                <p class="text-stone-300">Let's talk about your project and how I can help</p>
            </div>

            <form id="contact-form" class="space-y-6" action="https://formsubmit.co/kostas@kazazis.dev" method="POST">
                <input type="hidden" name="_subject" value="New Contact Form Submission from Portfolio" />
                <input type="hidden" name="_captcha" value="false" />
                <input type="hidden" name="_next" value="" />
                <input type="hidden" name="_template" value="box" />
                <input type="hidden" name="_autoresponse" value="Thank you for contacting me! I'll get back to you soon." />
                <input type="text" name="_honey" id="hp-website" autocomplete="off" tabindex="-1"
                    style="position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;opacity:0;" aria-hidden="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input
                        class="w-full px-4 py-3 bg-stone-700 border border-stone-600 rounded-lg text-white placeholder-stone-400 focus:outline-none focus:border-[#eb5424] transition"
                        type="text" name="name" id="name" placeholder="Your Name" required />
                    <input
                        class="w-full px-4 py-3 bg-stone-700 border border-stone-600 rounded-lg text-white placeholder-stone-400 focus:outline-none focus:border-[#eb5424] transition"
                        type="email" name="email" id="email" placeholder="Your Email" required />
                </div>

                <input
                    class="w-full px-4 py-3 bg-stone-700 border border-stone-600 rounded-lg text-white placeholder-stone-400 focus:outline-none focus:border-[#eb5424] transition"
                    type="text" name="subject" id="subject" placeholder="Subject" required />

                <textarea
                    class="w-full px-4 py-3 bg-stone-700 border border-stone-600 rounded-lg text-white placeholder-stone-400 focus:outline-none focus:border-[#eb5424] transition resize-none"
                    name="message" id="message" placeholder="Your Message" rows="6" required></textarea>

                <div id="form-message" class="hidden p-4 rounded-lg text-sm"></div>

                <button type="submit"
                    class="w-full py-3 bg-[#eb5424] hover:bg-[#c94219] text-white font-semibold rounded-lg transition transform hover:scale-105">
                    Send Message
                </button>
            </form>

            <p class="text-center text-stone-400 text-sm mt-8">
                Or email directly:
                <a href="mailto:kostas@kazazis.dev?subject=Contact%20from%20Portfolio"
                    class="text-[#eb5424] hover:underline">
                    kostas@kazazis.dev
                </a>
            </p>

            <div class="border-t border-stone-700 mt-8 pt-8 text-center text-stone-400 text-sm">
                <p>Copyright &copy; {{ date('Y') }} Kazazis Kostas</p>
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