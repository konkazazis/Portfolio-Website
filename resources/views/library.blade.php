@extends('master')

@section('title', 'Blog')
@section('meta_description', 'Thoughts on code, design, and the web — a developer blog by Kostas.')
@section('og_title', 'Blog · kostas')

@section('content')
    <section class="py-24 px-6 sm:px-8 bg-stone-50">
        <div class="mx-auto max-w-4xl flex flex-col">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-stone-900">Components</h1>
                <p class="text-stone-500 mt-2">A few UI pieces, shown live with their code.</p>
            </div>

            <x-component-showcase title="Navbar" description="Responsive nav with mobile toggle.">
                <x-slot:preview>
                    <nav class="flex items-center justify-between bg-white px-6 py-4 rounded-xl shadow-sm">
                        <span class="font-bold text-stone-900">Logo</span>
                        <div class="flex gap-6 text-sm text-stone-600">
                            <a href="#" class="hover:text-stone-900">Home</a>
                            <a href="#" class="hover:text-stone-900">About</a>
                            <a href="#" class="hover:text-stone-900">Contact</a>
                        </div>
                    </nav>
                </x-slot:preview>

               <x-slot:tailwind>
<nav class="flex items-center justify-between bg-white px-6 py-4 rounded-xl shadow-sm">
    <span class="font-bold text-stone-900">Logo</span>
    <div class="flex gap-6 text-sm text-stone-600">
        <a href="#" class="hover:text-stone-900">Home</a>
        <a href="#" class="hover:text-stone-900">About</a>
        <a href="#" class="hover:text-stone-900">Contact</a>
    </div>
</nav>
</x-slot:tailwind>

                <x-slot:css>
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 1rem 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.navbar a {
    color: #57534e;
    font-size: 0.875rem;
}
.navbar a:hover {
    color: #1c1917;
}
                </x-slot:css>
            </x-component-showcase>


        </div>
    </section>

    <x-contact />
@endsection