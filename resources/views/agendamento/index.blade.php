<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{ __('messages.agendamentos') }}" route="agendamentos.create" />
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($entities->count())
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-3 py-3">#</th>
                                        <th scope="col" class="px-3 py-3">Data</th>
                                        <th scope="col" class="px-3 py-3">Nome responsável</th>
                                        <th scope="col" class="px-3 py-3">E-mail</th>
                                        <th scope="col" class="px-3 py-3">Motivo</th>
                                        <th scope="col" class="px-3 py-3">Situação</th>
                                        <th scope="col" class="px-1 py-1">Ações</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entities as $entity)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                <button class="text-blue-500 hover:text-blue-600 hover:underline"
                                                data-modal-target="visualizar-agendamento-{{$entity->id}}"
                                                data-modal-toggle="visualizar-agendamento-{{$entity->id}}">
                                                    {{ $entity->id }}
                                            </button>
                                            </td>
                                            <td class="px-6 py-4">{{ $entity->data->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4">{{ $entity->nomeResponsavel }}</td>
                                            <td class="px-6 py-4">{{ $entity->email }}</td>
                                            <td class="px-6 py-4">{{ $entity->motivo }}</td>
                                            <td class="px-6 py-4">{{ $entity->situacao->getDescription() }}</td>
                                            <td class="px-2 py-1">

                                                <button data-modal-target="visualizar-agendamento-{{$entity->id}}"
                                                    data-modal-toggle="visualizar-agendamento-{{$entity->id}}"
                                                    class="text-black hover:text-gray-600 mr-2"
                                                    type="button">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>

                                                <x-button-edit route="agendamentos.edit" :entity="$entity" />

                                                <x-button-remove route="agendamentos.destroy" :entity="$entity" />

                                            </td>

                                        </tr>

                                        @include('agendamento.modal-show', $entity)
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $entities->links() !!}
                        </div>
                    @else
                        <div>Sem agendamentos cadastrados </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
