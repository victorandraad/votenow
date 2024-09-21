<x-guest-layout>
    <div class="py-12 bg-green-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <h1 class="text-7xl font-extrabold mb-6 text-center text-green-600 tracking-tight">
                        {{ $room->name }}
                    </h1>
                    
                    <div class="text-center mb-12">
                        <p class="text-4xl font-bold text-green-500 mb-2">Código da sala:</p>
                        <span class="text-5xl font-mono bg-green-100 px-4 py-2 rounded-lg shadow-inner">
                            {{ $room->code }}
                        </span>
                    </div>

                    <p class="text-center text-green-600 mb-12">
                        Criada em: {{ $room->created_at->format('d/m/Y \à\s H:i') }}
                    </p>

                    @foreach ($questions as $question)
                        <div class="mb-16 bg-green-50 p-6 rounded-lg shadow-md">
                            <h2 class="text-3xl font-semibold mb-6 text-green-800">{{ $question->question }}</h2>
                            @if ($question->image)
                                <img src="{{ $question->image }}" alt="Imagem da Pergunta" class="mb-8 max-w-md mx-auto rounded-lg shadow-md">
                            @endif
                            <form action="{{ route('votes.cast', $question) }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    @foreach ($question->options as $option)
                                        <label class="flex items-center p-4 bg-white rounded-lg shadow-sm hover:bg-green-100 transition cursor-pointer">
                                            <input type="radio" class="form-radio text-green-600" name="option_id" value="{{ $option->id }}" required>
                                            <span class="ml-3 text-green-700 text-lg">{{ $option->option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <button type="submit" class="mt-8 w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-xl">
                                    Votar
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
