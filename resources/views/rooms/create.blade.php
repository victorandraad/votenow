<x-app-layout>
    <div class="flex flex-col items-center justify-center flex-1 p-5">
        <div class="flex flex-col items-center justify-center">
            <i class="fas fa-plus-circle text-3xl text-green-500"></i>
            <h1 class="text-2xl font-bold mb-4 text-green-500">Criar Sala</h1>
        </div>

        <form action="{{ route('rooms.store') }}" method="POST" class="w-full max-w-md">
            @csrf
            <label for="name" id="labelName" class="block mb-2 text-sm font-medium text-gray-700">Nome da Sala</label>
            <x-text-input id="name" name="name" type="text" class="w-full mb-4" placeholder="Insira o nome da sala..." required />

            <x-primary-button class="w-full py-3">
                Criar sala
            </x-primary-button>
        </form>
    </div>
</x-app-layout>