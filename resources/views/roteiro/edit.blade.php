<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('messages.roteiroEdit') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('roteiros.update', $entity) }}">
                        @csrf
                        @method('PUT')
                        @include('roteiro._form', ['entity' => $entity])
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
