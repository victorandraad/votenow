<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Question to Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('rooms.store_question', $room->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="question" class="block text-sm font-medium text-gray-700">Question:</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="question" name="question" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image URL (optional):</label>
                            <input type="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="image" name="image">
                        </div>
                        <div id="options">
                            <div class="mb-4">
                                <label for="options[0][option]" class="block text-sm font-medium text-gray-700">Option 1:</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="options[0][option]" required>
                            </div>
                            <div class="mb-4">
                                <label for="options[1][option]" class="block text-sm font-medium text-gray-700">Option 2:</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="options[1][option]" required>
                            </div>
                        </div>
                        <button type="button" class="mb-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="addOption()">Add Option</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    let optionCount = 2;
    function addOption() {
        optionCount++;
        const optionHtml = `
            <div class="mb-4">
                <label for="options[${optionCount-1}][option]" class="block text-sm font-medium text-gray-700">Option ${optionCount}:</label>
                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="options[${optionCount-1}][option]" required>
            </div>
        `;
        document.getElementById('options').insertAdjacentHTML('beforeend', optionHtml);
    }
    </script>
</x-app-layout>
