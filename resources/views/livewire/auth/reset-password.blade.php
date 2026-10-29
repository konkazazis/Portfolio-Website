<x-simple :title="__('Reset password')">
    <div class="flex flex-col gap-6">
        <div class="text-center">
            <h1 class="font-serif text-3xl font-bold text-[#1C1B22] dark:text-stone-100">New password</h1>
            <p class="text-sm text-stone-500 dark:text-stone-400 mt-1">Choose a strong password</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <flux:input
                name="email"
                label="Email address"
                :value="old('email', $request->email)"
                type="email"
                required
                autocomplete="email"
            />
            @error('email')
                <p class="-mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror

            <flux:input
                name="password"
                label="New password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="At least 8 characters"
                viewable
            />
            @error('password')
                <p class="-mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror

            <flux:input
                name="password_confirmation"
                label="Confirm password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Repeat password"
                viewable
            />

            <button type="submit" class="admin-btn w-full">Reset password</button>
        </form>
    </div>
</x-simple>
