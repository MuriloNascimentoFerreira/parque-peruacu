<x-app-layout-convidado>
    <x-slot name="header">
        <x-views-header title="{{__('messages.agendamentoNew')}}"/>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('agendamento-convidado.store') }}">
                        @csrf
                        @include('agendamentoConvidado._form')
                    </form>
                </div>
            </div>


        </div>
    </div>

</x-app-layout-convidado>
