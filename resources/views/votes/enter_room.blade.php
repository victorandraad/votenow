<x-guest-layout>
    <div class="grow flex flex-col justify-center items-center">
        <h2 class="text-3xl font-bold mb-10">Entrar na Sala</h2>
        <form method="POST" action="{{ route('votes.join') }}">
            @csrf
                <x-text-input id="code" class="block mt-1 w-full text-center !py-2" type="text" name="code" :value="old('code')" placeholder="CÓDIGO DA SALA" required
                    autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2 text-center" />
                <x-primary-button class="mt-2 py-3">
                    {{ __('Entrar') }}
                </x-primary-button>
                <p class="text-sm mt-3">Não tem sala. <a href="{{ route('rooms.create') }}" class="text-green-500 underline">Crie aqui</a></p>
        </form>
    </div>
</x-guest-layout>
