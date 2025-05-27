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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <footer class="text-center">
            <h4>Desenvolvido por <a class="text-color-4" href="https://www.linkedin.com/in/murilonascimentoferreira/" target="_blank">Murilo Nascimento</a> &copy; 2025</h4>
        </footer>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </body>
</html>
