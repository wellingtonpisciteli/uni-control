<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UniControl') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 antialiased">

    <div class="min-h-screen">

        @include('layouts.sidebar')


        <main class="min-h-screen lg:ml-64">

            {{-- HEADER MOBILE --}}
            <header class="flex h-16 items-center border-b border-gray-200 bg-white px-4 lg:hidden">

                <button
                    type="button"
                    onclick="abrirSidebar()"
                    class="rounded-lg p-2 text-gray-600 hover:bg-gray-100"
                    aria-label="Abrir menu">

                    ☰

                </button>

                <a href="{{ route('dashboard') }}"
                   class="ml-3 text-xl font-bold">

                    <span class="text-orange-500">Uni</span>Control

                </a>

            </header>


            {{-- CONTEÚDO --}}
            @yield('content')

        </main>

    </div>


    {{-- JAVASCRIPT DO SIDEBAR --}}
    <script>

        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const closeButton = document.getElementById('sidebar-close');


        function abrirSidebar() {

            sidebar.classList.remove('-translate-x-full');

            overlay.classList.remove('hidden');

        }


        function fecharSidebar() {

            sidebar.classList.add('-translate-x-full');

            overlay.classList.add('hidden');

        }


        closeButton?.addEventListener('click', fecharSidebar);

        overlay?.addEventListener('click', fecharSidebar);


        document.querySelectorAll('#sidebar a').forEach(link => {

            link.addEventListener('click', () => {

                if (window.innerWidth < 1024) {

                    fecharSidebar();

                }

            });

        });

    </script>

</body>

</html>