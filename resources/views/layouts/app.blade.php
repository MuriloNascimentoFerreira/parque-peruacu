<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script>
            function setThemeIcon() {
                const icon = document.getElementById('theme-icon');
                if (document.documentElement.classList.contains('dark')) {
                    icon.className = 'fas fa-sun'; // Sol para tema escuro
                } else {
                    icon.className = 'fas fa-moon'; // Lua para tema claro
                }
            }

            // Detecta preferência do usuário ou sistema ao carregar a página
            window.addEventListener('DOMContentLoaded', function() {
                if (
                    localStorage.theme === 'dark' ||
                    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
                ) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                setThemeIcon(); // Atualiza o ícone ao carregar a página
            });
            // Função para alternar tema
            function toggleTheme() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
                setThemeIcon(); // Atualiza o ícone ao alternar o tema
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="text-center bg-white dark:bg-gray-800 py-4">
            <h4 class="text-gray-800 dark:text-gray-200">
            Desenvolvido por
            <a class="font-bold text-blue-800 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 hover:underline" href="https://www.linkedin.com/in/murilonascimentoferreira/" target="_blank">
                Murilo Nascimento
            </a>
            &copy; 2025
            </h4>
        </footer>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </body>
</html>
