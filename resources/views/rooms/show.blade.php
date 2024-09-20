<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Detalhes da Sala') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 mx-auto px-2">
            <div class="flex justify-between items-center mb-4">
            <div class="flex flex-col">
              <a href="{{ route('rooms.index') }}" class="text-sm text-green-500 hover:text-green-800 font-medium">
                  <i class="fas fa-arrow-left mr-2"></i>Voltar para salas
              </a>
                <h3 class="text-3xl font-bold mb-4 text-black">{{ $room->name }}</h3>
            </div>

                  <button onclick="navigator.clipboard.writeText('{{ $room->code }}')" class="flex items-center text-green-500 font-bold py-2 px-4 rounded transition duration-300">
                      <span class="text-xl mr-2">{{ $room->code }}</span>
                      <i class="fas fa-copy"></i>
                  </button>
            </div>

            <div class="flex flex-col bg-white shadow-lg p-4 rounded-lg gap-4">
                <h4 class="text-xl w-full font-semibold text-green-500">Perguntas</h4>

                @if($room->questions->isEmpty())
                <p class="font-medium text-gray-500">Nenhuma pergunta adicionada ainda.</p>
            @else
                <ul class="space-y-6">
                    @foreach($room->questions as $question)
                        <li class="bg-green-100 p-4 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:bg-green-200">
                            <h5 class="text-xl font-bold text-green-800 mb-4">{{ $question->question }}</h5>
                            @if($question->image)
                                <img src="{{ $question->image }}" alt="Imagem da Pergunta" class="mt-4 max-w-full h-auto rounded-lg shadow-sm">
                            @endif
                            <ul class="mt-4 space-y-2">
                                @foreach($question->options as $option)
                                    <li class="bg-white p-3 rounded-md shadow-sm flex items-center">
                                        <span class="w-6 h-6 flex items-center justify-center bg-green-500 text-white rounded-full mr-3 text-sm font-bold">{{ $loop->iteration }}</span>
                                        <span class="text-gray-800">{{ $option->option }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            @endif


                <a href="{{ route('rooms.add_question', $room->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-center">
                    Adicionar pergunta
                </a>
            </div>
    </div>
</x-app-layout>
