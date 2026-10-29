<x-simple :title="__('Confirm password')">
    <div class="flex flex-col gap-6">
        <div class="text-center">
            <h1 class="font-serif text-3xl font-bold text-[#1C1B22] dark:text-stone-100">Confirm password</h1>
            <p class="text-sm text-stone-500 dark:text-stone-400 mt-1">Please confirm your password to continue</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-4">
            @csrf

            <flux:input
                name="password"
                label="Password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Your password"
                viewable
            />
            @error('password')
                <p class="-mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror

            <button type="submit" class="admin-btn w-full">Confirm</button>
        </form>
    </div>
</x-simple>
