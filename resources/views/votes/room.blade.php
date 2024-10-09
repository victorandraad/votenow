<x-guest-layout>
    <div class="py-12">
        <x-dark-mode class="right-2"/>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-8">
                    <p class="text-center text-green-600 mb-12">
                        Criada em: {{ $room->created_at->format('d/m/Y \à\s H:i') }}
                    </p>

                    <h1 class="text-7xl font-extrabold mb-6 text-center text-green-600 tracking-tight">
                        {{ $room->name }}
                    </h1>

                    <div class="text-center mb-12 flex flex-col lg:w-2/6 mx-auto">
                        <p class="text-4xl font-bold text-green-500 mb-2">Código da sala:</p>
                        <span class="text-5xl font-mono bg-green-100 px-4 py-2 rounded-lg shadow-inner">
                            {{ $room->code }}
                        </span>
                    </div>

                    

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

    <script>
    function mudarCor() {
        const page = document.body;
        const buttonIcon = document.getElementById('buttonIcon');
        const button = document.getElementById('themeButton');

        // Alternar classes do tema da página
        page.classList.toggle('bg-slate-200'); // Claro
        page.classList.toggle('bg-zinc-700'); // Escuro
        page.classList.toggle('text-black'); // Claro
        page.classList.toggle('text-white'); // Escuro

        // Alterar o ícone e estilo do botão
        if (page.classList.contains('bg-zinc-700')) {
            buttonIcon.src = "https://cdn-icons-png.flaticon.com/512/6714/6714978.png"; // Ícone escuro
            button.classList.add('bg-zinc-800', 'shadow-gray-900'); // Botão escuro
            button.classList.remove('bg-white', 'shadow-gray-300'); // Remover tema claro do botão
        } else {
            buttonIcon.src = "https://static.thenounproject.com/png/4802375-200.png"; // Ícone claro
            button.classList.add('bg-white', 'shadow-gray-300'); // Botão claro
            button.classList.remove('bg-zinc-800', 'shadow-gray-900'); // Remover tema escuro do botão
        }

        // Salvar a preferência do tema no localStorage
        const isDark = page.classList.contains('bg-zinc-700');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    // Carregar o tema salvo no localStorage quando a página for carregada
    window.onload = () => {
        const theme = localStorage.getItem('theme');
        const page = document.getElementById('page');
        const buttonIcon = document.getElementById('buttonIcon');
        const button = document.getElementById('themeButton');

        if (theme === 'dark') {
            page.classList.add('bg-zinc-700', 'text-white');
            page.classList.remove('bg-slate-200', 'text-black');
            buttonIcon.src = "https://cdn-icons-png.flaticon.com/512/6714/6714978.png"; // Ícone escuro
            button.classList.add('bg-zinc-800', 'shadow-gray-900');
            button.classList.remove('bg-white', 'shadow-gray-300');
        } else {
            page.classList.add('bg-slate-200', 'text-black');
            page.classList.remove('bg-zinc-700', 'text-white');
            buttonIcon.src = "https://static.thenounproject.com/png/4802375-200.png"; // Ícone claro
            button.classList.add('bg-white', 'shadow-gray-300');
            button.classList.remove('bg-zinc-800', 'shadow-gray-900');
        }
    }
</script>


</x-guest-layout>
