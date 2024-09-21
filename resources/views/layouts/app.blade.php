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
        <div class="min-h-screen bg-gray-50 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="flex justify-center pt-5">
                <x-application-logo class="mx-auto w-52" />
            </header>

            <!-- Page Content -->
            <main class="flex-1 pt-5 px-4 mb-16 flex flex-col">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
