<x-app-layout>
    <x-slot name="header">
        <h1 class="text-6xl font-extrabold text-center text-green-600 tracking-tight mb-4">
            {{ __('Suas Salas') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-8">
                    <a href="{{ route('rooms.create') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg mb-8 text-xl transition duration-300">
                        Criar Nova Sala
                    </a>
                    
                    @if($rooms->isEmpty())
                        <p class="text-2xl text-center text-green-700">Você ainda não tem nenhuma sala.</p>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($rooms as $room)
                                <div class="bg-green-100 rounded-lg shadow-md p-6">
                                    <h2 class="text-3xl font-bold text-green-800 mb-2">{{ $room->name }}</h2>
                                    <p class="text-xl text-black font-mono bg-green-200 px-3 py-1 rounded mb-4">{{ $room->code }}</p>
                                    <div class="flex justify-between">
                                        <a href="{{ route('rooms.show', $room->code) }}" class="btn bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Ver</a>
                                        <a href="{{ route('rooms.add_question', $room->code) }}" class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Adicionar Pergunta</a>
                                        <form action="{{ route('rooms.destroy', $room->code) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Tem certeza?')">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>