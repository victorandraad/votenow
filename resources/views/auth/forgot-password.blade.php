<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}" class="mt-8 w-full max-w-xl">
        @csrf

        <p class="text-gray-500 my-12 text-center">
            Esqueceu sua senha? Não se preocupe. Insira seu endereço de email e enviaremos um link para redefinir sua
            senha.
        </p>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Insira seu email..." class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-end mt-6">
            <x-primary-button class="mt-4 w-full text-lg">
                {{ __('Redefinir senha') }}
            </x-primary-button>

            <a class="text-sm text-gray-600 rounded-md focus:outline-none mt-1" href="{{ route('login') }}">
                <span class="hover:text-green-500">{{ __('Lembrou sua senha?') }}</span>
            </a>
        </div>
    </form>
</x-guest-layout>