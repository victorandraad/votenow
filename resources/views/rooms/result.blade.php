<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room Results: ') . $room->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen mx-auto sm:px-6 lg:px-8 rounded-lg">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Código da Sala	: {{ $room->code }}</h3>
                    
                    @foreach ($questions as $question)
                        <div class="mb-10 p-6 bg-gray-50 rounded-xl shadow-md">
                            <h4 class="text-xl font-bold mb-4 text-[#078951]">{{ $question->question }}</h4>
                            @if ($question->image)
                                <img src="{{ $question->image }}" alt="Question Image" class="mb-6 max-w-full h-auto rounded-lg shadow-sm">
                            @endif
                            
                            @php
                                $maxVotes = $question->options->max('votes_count');
                                $totalVotes = $question->options->sum('votes_count');
                            @endphp
                            
                            <ul class="space-y-4">
                                @foreach ($question->options as $option)
                                    @php
                                        $percentage = $totalVotes > 0 ? ($option->votes_count / $totalVotes) * 100 : 0;
                                    @endphp
                                    <li class="relative">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium text-gray-700">{{ $option->option }}</span>
                                            <span class="font-semibold text-[#09c269]">{{ $option->votes_count }} votes ({{ number_format($percentage, 1) }}%)</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                            <div class="h-full rounded-full {{ $option->votes_count == $maxVotes ? 'bg-[#09c269]' : 'bg-[#6ee0a8]' }}" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Iniciando Echo para a sala: {{ $room->code }}');
            window.Echo.channel('room.{{ $room->code }}')
                .listen('VoteUpdated', (e) => {
                    console.log('Evento VoteUpdated recebido:', e);
                    const optionElement = document.querySelector(`#option-${e.optionId} .vote-count`);
                    if (optionElement) {
                        optionElement.textContent = `${e.voteCount} votes`;
                        console.log('Elemento atualizado:', optionElement);
                    } else {
                        console.log('Elemento não encontrado para o optionId:', e.optionId);
                    }
                });
            
            console.log('Canais ativos:', window.Echo.connector.channels);
        });
    </script>
    @endpush
</x-app-layout>
