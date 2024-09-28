<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="mt-8 w-full max-w-xl">
        @csrf

        <p class="text-gray-500 my-12 text-center">Um aplicativo para realizar votações temporárias.</p>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" placeholder="Insira seu nome..." class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Insira seu email..." class="block mt-1 w-full" type="email"
                name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                placeholder="Insira sua senha..." required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

            <x-text-input id="password_confirmation" placeholder="Confirme sua senha..." class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-end mt-6">
            <x-primary-button>
                {{ __('Criar conta') }}
            </x-primary-button>
            <a class="text-sm text-gray-600 rounded-md focus:outline-none mt-1" href="{{ route('login') }}">
                <span class="hover:text-green-500">{{ __('Já possui uma conta?') }}</span>
            </a>

        </div>
    </form>
</x-guest-layout>