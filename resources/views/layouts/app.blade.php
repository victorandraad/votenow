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
            <button class="h-12 w-12 absolute right-7 rounded-full" onclick="mudarCor()">
                <img src="https://www.freeiconspng.com/uploads/sun-icon-15.png" alt="" class="h-10 w-10 rounded-full">
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
        
        // Trocar classes de fundo
        page.classList.toggle('bg-slate-200'); // Tema claro
        page.classList.toggle('bg-zinc-700'); // Tema escuro

        // Trocar classes do componente de navegação
        nav.classList.toggle('bg-slate-200'); // Tema claro
        nav.classList.toggle('bg-zinc-800'); // Tema escuro
        nav.classList.toggle('text-black'); // Tema claro
        nav.classList.toggle('text-white'); // Tema escuro

        // Salvar a preferência do usuário no localStorage
        const isDark = page.classList.contains('bg-zinc-700');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

    window.onload = () => {
        const theme = localStorage.getItem('theme');
        const page = document.getElementById('page');
        const nav = document.querySelector('nav');

        // Limpar classes de tema antes de aplicar
        page.classList.remove('bg-slate-200', 'bg-zinc-700', 'text-black', 'text-white');
        nav.classList.remove('bg-slate-200', 'bg-zinc-800', 'text-black', 'text-white');

        // Aplicar classes baseadas na preferência
        if (theme === 'dark') {
            page.classList.add('bg-zinc-700', 'text-white');
            nav.classList.add('bg-zinc-800', 'text-white');
        } else {
            page.classList.add('bg-slate-200', 'text-black');
            nav.classList.add('bg-slate-200', 'text-black');
        }
    };
</script>



</body>