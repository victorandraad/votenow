<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @php
        $theme = session('theme', 'light'); // Define o tema padrão como 'light'
    @endphp

    <div id="page" class="min-h-screen bg-slate-200 flex flex-col">
        @include('layouts.navigation', ['theme' => $theme])

        <!-- Page Heading -->
        <header class="flex justify-center pt-5">
            <x-application-logo class="mx-auto w-52 md:hidden" />
            <button id="themeButton" class="h-12 w-12 absolute right-7 rounded-full bg-white shadow-md shadow-gray-300" onclick="mudarCor()">
                <img id="buttonIcon" src="https://static.thenounproject.com/png/4676033-200.png" alt="Botão de tema">
            </button>
        </header>

        <!-- Page Content -->
        <main class="flex-1 pt-5 px-4 mb-16 flex flex-col">
            {{ $slot }}
        </main>
    </div>

    <script>
        function mudarCor() {
            const page = document.getElementById('page');
            const nav = document.querySelector('nav');
            const button = document.getElementById('themeButton');
            const buttonIcon = document.getElementById('buttonIcon');
            console.log("aa")

            // Trocar classes de fundo da página
            page.classList.toggle('bg-slate-200'); // Tema claro
            page.classList.toggle('bg-zinc-700'); // Tema escuro

            // Trocar classes de navegação
            nav.classList.toggle('bg-slate-200'); // Tema claro
            nav.classList.toggle('bg-zinc-800'); // Tema escuro
            nav.classList.toggle('text-black'); // Tema claro
            nav.classList.toggle('text-white'); // Tema escuro

            // Alternar imagem e classes do botão
            if (page.classList.contains('bg-zinc-700')) {
                buttonIcon.src = "data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M12.3%204.9c.4-.2.6-.7.5-1.1s-.6-.8-1.1-.8C6.8%203.1%203%207.1%203%2012c0%205%204%209%209%209%203.8%200%207.1-2.4%208.4-5.9.2-.4%200-.9-.4-1.2-.4-.3-.9-.2-1.2.1-1%20.9-2.3%201.4-3.7%201.4-3.1%200-5.7-2.5-5.7-5.7%200-1.9%201.1-3.8%202.9-4.8zm2.8%2012.5c.5%200%201%200%201.4-.1-1.2%201.1-2.8%201.7-4.5%201.7-3.9%200-7-3.1-7-7%200-2.5%201.4-4.8%203.5-6-.7%201.1-1%202.4-1%203.8-.1%204.2%203.4%207.6%207.6%207.6z%22%2F%3E%3C%2Fsvg%3E"; // Ícone para tema escuro
                button.classList.add('bg-zinc-800', 'shadow-gray-900'); // Botão escuro
                button.classList.remove('bg-white', 'shadow-gray-300'); // Remover tema claro do botão
            } else {
                buttonIcon.src = "https://static.thenounproject.com/png/4676034-200.png"; // Ícone para tema claro
                button.classList.add('bg-white', 'shadow-gray-300'); // Botão claro
                button.classList.remove('bg-zinc-800', 'shadow-gray-900'); // Remover tema escuro do botão
            }

            // Salvar a preferência do usuário no localStorage
            const isDark = page.classList.contains('bg-zinc-700');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        window.onload = () => {
            const theme = localStorage.getItem('theme');
            const page = document.getElementById('page');
            const nav = document.querySelector('nav');
            const button = document.getElementById('themeButton');
            const buttonIcon = document.getElementById('buttonIcon');

            // Limpar classes de tema antes de aplicar
            page.classList.remove('bg-slate-200', 'bg-zinc-700', 'text-black', 'text-white');
            nav.classList.remove('bg-slate-200', 'bg-zinc-800', 'text-black', 'text-white');

            // Aplicar classes baseadas na preferência
            if (theme === 'dark') {
                page.classList.add('bg-zinc-700', 'text-white');
                nav.classList.add('bg-zinc-800', 'text-white');
                buttonIcon.src = "data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M12.3%204.9c.4-.2.6-.7.5-1.1s-.6-.8-1.1-.8C6.8%203.1%203%207.1%203%2012c0%205%204%209%209%209%203.8%200%207.1-2.4%208.4-5.9.2-.4%200-.9-.4-1.2-.4-.3-.9-.2-1.2.1-1%20.9-2.3%201.4-3.7%201.4-3.1%200-5.7-2.5-5.7-5.7%200-1.9%201.1-3.8%202.9-4.8zm2.8%2012.5c.5%200%201%200%201.4-.1-1.2%201.1-2.8%201.7-4.5%201.7-3.9%200-7-3.1-7-7%200-2.5%201.4-4.8%203.5-6-.7%201.1-1%202.4-1%203.8-.1%204.2%203.4%207.6%207.6%207.6z%22%2F%3E%3C%2Fsvg%3E"; // Ícone para tema escuro
                button.classList.add('bg-zinc-800', 'shadow-gray-900'); // Botão escuro
                button.classList.remove('bg-white', 'shadow-gray-300'); // Remover tema claro do botão
            } else {
                page.classList.add('bg-slate-200', 'text-black');
                nav.classList.add('bg-slate-200', 'text-black');
                buttonIcon.src = "https://static.thenounproject.com/png/4676034-200.png"; // Imagem para tema claro
                button.classList.add('bg-white', 'shadow-gray-300'); // Botão claro
                button.classList.remove('bg-zinc-800', 'shadow-gray-900'); // Remover tema escuro do botão
            }
        };
    </script>

</body >
