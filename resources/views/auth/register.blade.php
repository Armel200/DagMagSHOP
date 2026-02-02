<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" 
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" 
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            
            <div class="relative flex items-center">
                <x-text-input id="password" 
                    class="block mt-1 w-full pr-10 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                    type="password" name="password" required autocomplete="new-password" />

                <!-- Icône œil -->
                <button type="button" onclick="togglePassword('password')" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3" tabindex="-1">
                    <svg id="eyeOpen-password" xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-black hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eyeClosed-password" xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.974 9.974 0 013.1-4.868m2.128-1.68A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.974 9.974 0 01-4.046 4.764M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3v0m0 0l-7 7" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative flex items-center">
                <x-text-input id="password_confirmation" 
                    class="block mt-1 w-full pr-10 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />

                <!-- Icône œil -->
                <button type="button" onclick="togglePassword('password_confirmation')" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3" tabindex="-1">
                    <svg id="eyeOpen-password_confirmation" xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-black hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eyeClosed-password_confirmation" xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.974 9.974 0 013.1-4.868m2.128-1.68A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.974 9.974 0 01-4.046 4.764M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3v0m0 0l-7 7" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            <p class="text-gray text-sm">
                Vous avez déjà un compte ? 
                <a href="{{ route('login') }}" class="text-blue-500 font-medium hover:underline">Se connecter</a>
            </p>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script toggle -->
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eyeOpen = document.getElementById(`eyeOpen-${id}`);
            const eyeClosed = document.getElementById(`eyeClosed-${id}`);

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            }
        }
    </script>
</x-guest-layout>
