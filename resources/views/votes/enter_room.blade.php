<x-guest-layout>
    <div class="grow flex flex-col justify-center items-center">
        <!-- <x-application-logo class="mb-10" /> -->
        <x-dark-mode class="right-2"/>
        <h2 class="text-3xl font-bold mb-10 mt-15">Entrar na Sala</h2>
        <form method="POST" action="{{ route('votes.join') }}">
            @csrf
                <x-text-input id="code" class="block mt-1 w-full text-center !py-2" type="text" name="code" :value="old('code')" placeholder="CÓDIGO DA SALA" required
                    autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2 text-center" />
                <x-primary-button class="mt-2 py-3">
                    {{ __('Entrar') }}
                </x-primary-button>
                <p class="text-sm mt-3">Não tem sala. <a href="{{ route('rooms.create') }}" class="text-green-500 underline">Crie aqui</a></p>
        </form>
    </div>

    <script>
    function mudarCor() {
        const page = document.body;
        const button = document.getElementById('themeButton');
        const buttonIcon = document.getElementById('buttonIcon');
        const caixaTexto = document.getElementById('caixaTexto');

        // Alternar classes de fundo da página
        page.classList.toggle('bg-slate-200'); // Tema claro
        page.classList.toggle('bg-zinc-700'); // Tema escuro
        page.classList.toggle('text-black'); // Texto claro
        page.classList.toggle('text-white'); // Texto escuro

        caixaTexto.classList.toggle('bg-transparent')

        // Alternar imagem e classes do botão
        if (page.classList.contains('bg-zinc-700')) {
            buttonIcon.src = "https://cdn-icons-png.flaticon.com/512/6714/6714978.png"; // Ícone para tema escuro
            button.classList.add('bg-zinc-800', 'shadow-gray-900'); // Botão escuro
            button.classList.remove('bg-white', 'shadow-gray-300'); // Remover tema claro do botão
        } else {
            buttonIcon.src = "https://static.thenounproject.com/png/4802375-200.png"; // Ícone para tema claro
            button.classList.add('bg-white', 'shadow-gray-300'); // Botão claro
            button.classList.remove('bg-zinc-800', 'shadow-gray-900'); // Remover tema escuro do botão
        }

        // Salvar a preferência do usuário no localStorage
        const isDark = page.classList.contains('bg-zinc-700');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    window.onload = () => {
        const theme = localStorage.getItem('theme');
        const page = document.body; // ou document.getElementById('page') se aplicável
        const button = document.getElementById('themeButton');
        const buttonIcon = document.getElementById('buttonIcon');

        // Limpar classes de tema antes de aplicar
        page.classList.remove('bg-slate-200', 'bg-zinc-700', 'text-black', 'text-white');

        // Aplicar classes baseadas na preferência
        if (theme === 'dark') {
            page.classList.add('bg-zinc-700', 'text-white');
            buttonIcon.src = "https://cdn-icons-png.flaticon.com/512/6714/6714978.png"; // Ícone para tema escuro
            button.classList.add('bg-zinc-800', 'shadow-gray-900'); // Botão escuro
            button.classList.remove('bg-white', 'shadow-gray-300'); // Remover tema claro do botão
            caixaTexto.classList.add('bg-transparent')
        } else {
            page.classList.add('bg-slate-200', 'text-black');
            buttonIcon.src = "https://static.thenounproject.com/png/4802375-200.png"; 
            button.classList.add('bg-white', 'shadow-gray-300'); // Botão claro
            button.classList.remove('bg-zinc-800', 'shadow-gray-900'); // Remover tema escuro do botão
            caixaTexto.classList.remove('bg-transparent')
        }
    };
    </script>


</x-guest-layout>

