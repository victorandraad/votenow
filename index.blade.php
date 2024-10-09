<x-app-layout>
    <x-slot name="header">
        <h1 class="text-6xl font-extrabold text-center text-green-600 tracking-tight mb-4">
            {{ __('Suas Salas') }}
        </h1>
    </x-slot>
    <div id="mensagens"></div>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                                    <p class="text-xl font-mono bg-green-200 px-3 py-1 rounded mb-4">{{ $room->code }}</p>
                                    <div class="flex justify-between">
                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Ver</a>
                                        <a href="{{ route('rooms.add_question', $room->id) }}" class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Adicionar Pergunta</a>
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline">
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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // import Pusher from 'pusher-js';

        // document.addEventListener('DOMContentLoaded', function() {
        //     const pusher = new Pusher('633a0c8b47f2ea10328a', {
        //         cluster: 'us2',
        //     });
    
        //     const channel = pusher.subscribe('chat');
        //     channel.bind('MensagemEnviada', function(data) {
        //         console.log('Recebido:', data);
        //     });
        // });

         // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('633a0c8b47f2ea10328a', {
            cluster: 'us2'
        });

        document.addEventListener('DOMContentLoaded', function() {
            const channel = pusher.subscribe('chat');
            channel.bind('MensagemEnviada', function(data) {
                // Obtém o elemento onde as mensagens serão exibidas
                const mensagensDiv = document.getElementById('mensagens');
                
                // Cria um novo elemento para a mensagem
                const novaMensagem = document.createElement('div');
                novaMensagem.textContent = data; // Ajuste conforme o formato do seu objeto

                // Adiciona a nova mensagem ao DOM
                mensagensDiv.appendChild(novaMensagem);
                console.log("Teste: " + data);
            });
        });
        
    </script>
</x-app-layout>