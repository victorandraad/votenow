<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 w-full max-w-xl">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Insira seu email..." class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" placeholder="Insira sua senha..." class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-between mt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
            </label>

            @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 hover:text-green-500 rounded-md focus:outline-none"
                href="{{ route('password.request') }}">
                {{ __('Esqueceu sua senha?') }}
            </a>
            @endif
        </div>
        <div class="flex flex-col items-end mt-6">
            <x-primary-button class="mt-4 w-full">
                {{ __('Entrar') }}
            </x-primary-button>

            <a class="text-sm text-gray-600 rounded-md focus:outline-none mt-1" href="{{ route('register') }}">
                <span class="hover:text-green-500">{{ __('Não possui uma conta?') }}</span>
                <span class="text-gray-600 hover:text-green-500">{{ __('Cadastre-se aqui.') }}</span>
            </a>
        </div>
    </form>
</x-guest-layout>