@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="flex items-center justify-center min-h-[100vh]">

        <form action="{{ route('register') }}" method="post" class="w-full max-w-80 flex flex-col gap-4">

            @csrf

            <h1 class="font-serif text-3xl font-bold tracking-tight mb-2">
                Register
            </h1>
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-stone-700" for="username">Username</label>
                {{-- <svg class="form-icon-left" width="14" height="14" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg> --}}
                <input
                    class="px-4 py-2.5 rounded-lg border border-stone-200 bg-white text-stone-900 text-sm outline-none focus:border-stone-400 transition-colors"
                    type="text" name="username" placeholder="Username" id="username" value="{{ old('username') }}" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-stone-700" for="email">Email</label>
                {{-- <svg class="form-icon-left" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                </svg> --}}
                <input
                    class="px-4 py-2.5 rounded-lg border border-stone-200 bg-white text-stone-900 text-sm outline-none focus:border-stone-400 transition-colors"
                    type="email" name="email" placeholder="Email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="form-label" for="password">Password</label>
                {{-- <svg class="form-icon-left" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                </svg> --}}
                <input
                    class="px-4 py-2.5 rounded-lg border border-stone-200 bg-white text-stone-900 text-sm outline-none focus:border-stone-400 transition-colors"
                    type="password" name="password" placeholder="Password" id="password" autocomplete="new-password"
                    required>
            </div>

            @if ($errors->any())
                <div class="text-amber-500">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <button
                class="mt-2 px-6 py-2.5 rounded-lg text-sm font-medium bg-stone-900 text-stone-50 hover:bg-stone-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                type="submit">Register</button>

            <p class="register-link">Already have an account? <a href="{{ route('login') }}" class="form-link">Login</a></p>

        </form>

    </div>
@endsection