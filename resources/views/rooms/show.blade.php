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
                        <span id="room_code" class="text-5xl font-mono bg-green-100 px-4 py-2 rounded-lg shadow-inner">
                            {{ $room->code }}
                        </span>
                    </div>

                    <p class="text-center text-green-600 mb-12">
                        Criada em: {{ $room->created_at->format('d/m/Y \à\s H:i') }}
                    </p>

                    <div id="questions-container">
                        @foreach ($questions as $question)
                            <div class="mb-16 bg-green-50 p-6 rounded-lg shadow-md">
                                <h2 class="text-3xl font-semibold mb-6 text-green-800">{{ $question->question }}</h2>
                                @if ($question->image)
                                    <img src="{{ $question->image }}" alt="Imagem da Pergunta" class="mb-8 max-w-md mx-auto rounded-lg shadow-md">
                                @endif
                                <div class="space-y-4">
                                    @foreach ($question->options as $option)
                                        <label class="flex items-center p-4 bg-white rounded-lg shadow-sm hover:bg-green-100 transition cursor-pointer">
                                            <input type="radio" class="form-radio text-green-600" name="question-{{ $question->id }}" value="{{ $option->id }}" required>
                                            <span class="ml-3 text-green-700 text-lg">{{ $option->option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button id="submit-all" class="mt-8 w-full bg-green-800 hover:bg-green-900 text-white font-bold py-4 px-6 rounded-lg transition duration-300 text-xl">
                        Enviar Todos os Votos
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var room_code = document.querySelector("#room_code").textContent.trim()

        document.getElementById('submit-all').addEventListener('click', function() {
            const votesArray = [];
            const questions = document.querySelectorAll('#questions-container > div');

            questions.forEach(question => {
                const questionId = question.querySelector('input[type="radio"]').name.split('-')[1];
                const selectedOption = question.querySelector('input[type="radio"]:checked');

                if (selectedOption) {
                    votesArray.push({
                        questionId: questionId,
                        optionId: selectedOption.value
                    });
                }
            });

            if (votesArray.length === 0) {
                alert("Você não selecionou nenhuma opção.");
                return;
            }

            // Envia os dados armazenados
            votesArray.forEach(vote => {
                fetch(`{{ route('votes.cast', '') }}/${vote.questionId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ option_id: vote.optionId })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            });

            window.location.href = "/results/" + room_code
        });
    </script>
</x-guest-layout>
