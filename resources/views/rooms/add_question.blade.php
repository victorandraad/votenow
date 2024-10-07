<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Nova Pergunta') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 mx-auto px-2">
        <div class="flex justify-between items-center mb-4">
            <div class="flex flex-col">
                <a href="{{ route('rooms.show', $room->code) }}" class="text-sm text-green-500 hover:text-green-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar para detalhes da sala
                </a>
                <h3 class="text-3xl font-bold mb-4 text-black">Adicionar pergunta</h3>
            </div>
        </div>

        <form action="{{ route('rooms.store_question', $room->code) }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="question" :value="__('Pergunta:')" />
                <x-text-input id="question" class="block mt-1 w-full" type="text" name="question" required />
            </div>

            <div class="mb-4">
                <x-input-label for="image" :value="__('URL da Imagem (opcional):')" />
                <x-text-input id="image" class="block mt-1 w-full" type="url" name="image" />
            </div>

            <h4 class="text-lg font-semibold mb-1">{{ __('Opções') }}</h4>
            
                <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                        <div id="options" class="flex flex-col gap-2">
                          <x-text-input class="block w-full mr-2" type="text" name="options[0][option]" placeholder="Opção 1" required />
                          <x-text-input class="block w-full mr-2" type="text" name="options[1][option]" placeholder="Opção 2" required />
                        </div>
                        <x-secondary-button type="button" class="mt-4 w-full flex items-center justify-center py-4 hover:bg-gray-200" onclick="addOption()">
                    {{ __('Adicionar Opção') }} <i class="fas fa-plus ml-2"></i>
                </x-secondary-button>
            </div>

            <x-primary-button type="submit">
                {{ __('Adicionar Pergunta') }}
            </x-primary-button>
        </form>
    </div>

    <script>
        let optionCount = 2;

        function addOption() {
            optionCount++;
            const optionHtml = `
            <div class="mb-4 flex items-center">
                <div class="flex w-full items-center border border-gray-300 rounded-md shadow-sm pr-3 focus-within:ring-1 focus-within:ring-green-500 focus-within:border-green-500">
                    <x-text-input class="block w-full border-0 focus:ring-0 focus:border-0" type="text" name="options[${optionCount-1}][option]" placeholder="Opção ${optionCount}" required />
                    <button type="button" class="text-black hover:text-gray-700" onclick="deleteOption(this)">
                        <i class="fas fa-x"></i>
                    </button>
                </div>
            </div>
        `;
            document.getElementById('options').insertAdjacentHTML('beforeend', optionHtml);
        }

        function deleteOption(button) {
            button.closest('.mb-4').remove();
            updateOptionNumbers();
        }

        function updateOptionNumbers() {
            const options = document.querySelectorAll('#options .mb-4');
            options.forEach((option, index) => {
                const input = option.querySelector('input');
                input.name = `options[${index}][option]`;
                input.placeholder = `Opção ${index + 1}`;
            });
            optionCount = options.length;
        }
    </script>
</x-app-layout>