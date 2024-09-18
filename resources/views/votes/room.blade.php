<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">{{ $room->name }}</h2>
                    @foreach ($questions as $question)
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold mb-2">{{ $question->question }}</h3>
                            @if ($question->image)
                                <img src="{{ $question->image }}" alt="Question Image" class="mb-4 max-w-md">
                            @endif
                            <form action="{{ route('votes.cast', $question) }}" method="POST">
                                @csrf
                                @foreach ($question->options as $option)
                                    <div class="mb-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio" name="option_id" value="{{ $option->id }}" required>
                                            <span class="ml-2">{{ $option->option }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Vote
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
