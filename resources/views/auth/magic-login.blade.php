<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('magic-login-store') }}">
        @csrf

        <h2 class="text-center font-bold dark:text-white">Ambiente visitantes</h2>

        @if (Session::has('success'))
            <div class="w-full p-4 rounded bg-green-100 text-green-600 font-bold my-4">
                Link de autenticação enviado! <br>
                Acesse seu email para continuar.
            </div>

        @endif
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- link para acessar pagina de funcionario --}}
        <div class="flex items-center justify-start mt-4">
            @if (Route::has('magic-register-create'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('magic-register-create') }}">
                    {{ __('Registre-se') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-2">

            @if (Route::has('login'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Página do funcionário') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('messages.login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
