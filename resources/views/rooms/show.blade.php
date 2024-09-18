<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ $room->name }}</h3>
                    <p><strong>Code:</strong> {{ $room->code }}</p>
                    <p><strong>Created at:</strong> {{ $room->created_at->format('Y-m-d H:i:s') }}</p>

                    <h4 class="text-md font-semibold mt-6 mb-2">Questions:</h4>
                    @if($room->questions->isEmpty())
                        <p>No questions added yet.</p>
                    @else
                        <ul>
                            @foreach($room->questions as $question)
                                <li class="mb-4">
                                    <strong>{{ $question->question }}</strong>
                                    @if($question->image)
                                        <img src="{{ $question->image }}" alt="Question Image" class="mt-2 max-w-xs">
                                    @endif
                                    <ul class="ml-4 mt-2">
                                        @foreach($question->options as $option)
                                            <li>{{ $option->option }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('rooms.add_question', $room->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Question
                        </a>
                        <a href="{{ route('rooms.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Back to Rooms
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
