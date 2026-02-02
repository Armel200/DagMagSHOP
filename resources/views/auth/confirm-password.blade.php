<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900 px-4">
        <!-- Logo -->
        <div class="mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto mx-auto">
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 text-center mb-4">
                Confirmation requise
            </h2>
            <p class="text-center text-gray-500 dark:text-gray-400 text-sm mb-6">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-600 dark:text-gray-300" />

                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                                    type="password"
                                    name="password"
                                    onclick="togglePassword()"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
     <script>
          function togglePassword() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</x-guest-layout>
