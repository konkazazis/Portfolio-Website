<x-simple :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <div class="text-center">
            <h1 class="font-serif text-3xl font-bold text-[#1C1B22] dark:text-stone-100">Reset password</h1>
            <p class="text-sm text-stone-500 dark:text-stone-400 mt-1">Enter your email to receive a reset link</p>
        </div>

        @if (session('status'))
            <div class="text-sm text-emerald-600 dark:text-emerald-400 text-center font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
            @csrf

            <flux:input
                name="email"
                label="Email address"
                :value="old('email')"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />
            @error('email')
                <p class="-mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror

            <button type="submit" class="admin-btn w-full">Send reset link</button>
        </form>

        <p class="text-sm text-center text-stone-500 dark:text-stone-400">
            <a href="{{ route('login') }}" class="font-semibold text-[#1C1B22] dark:text-stone-100 underline decoration-[#FFE45C] decoration-4 underline-offset-2">
                Back to login
            </a>
        </p>
    </div>
</x-simple>
