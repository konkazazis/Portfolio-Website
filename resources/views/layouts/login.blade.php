@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="flex items-center justify-center min-h-[100vh]">

        <form action="{{ route('login') }}" method="post" class="w-full max-w-80 flex flex-col gap-4">

            @csrf

            <h1 class="font-serif text-3xl font-bold tracking-tight mb-2">
                Sign in
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
                <label class="text-sm font-medium text-stone-700" for="password">Password</label>
                {{-- <svg class="form-icon-left" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                </svg> --}}
                <input
                    class="px-4 py-2.5 rounded-lg border border-stone-200 bg-white text-stone-900 text-sm outline-none focus:border-stone-400 transition-colors"
                    type="password" name="password" placeholder="Password" id="password" required>
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
                type="submit">Login</button>

            {{-- <p class="register-link">Don't have an account? <a href="{{ route('register') }}"
                    class="form-link">Register</a> --}}
            </p>

        </form>

    </div>
@endsection