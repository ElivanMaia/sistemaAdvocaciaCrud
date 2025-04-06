<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" onclick="togglePasswordVisibility()">
                <span class="ms-2 text-sm text-gray-600">{{ __('Mostrar Senha') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex">
                <div class="mr-2">
                    <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        Não tem uma conta?ㅤ
                    </a>
                </div>
                @if (Route::has('password.request'))
                    <div>
                        <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    </div>
                @endif
            </div>

            <x-primary-button class="ms-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var rememberMeCheckbox = document.getElementById("remember_me");

            if (rememberMeCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</x-guest-layout>
