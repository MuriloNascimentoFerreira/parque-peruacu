<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{ __('messages.agendamentos') }}" />
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-screen">
                <div class="p-6 text-gray-900 dark:text-gray-100 h-screen">

                    @if ($entities->count())
                        <div class="relative overflow-x-auto h-screen">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-3 py-3">#</th>
                                        <th scope="col" class="px-3 py-3">Data solicitação</th>
                                        <th scope="col" class="px-3 py-3">Data visita</th>
                                        <th scope="col" class="px-3 py-3">Nome responsável</th>
                                        <th scope="col" class="px-3 py-3">E-mail</th>
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
                                            <td class="px-6 py-4">{{ isset($entity->visita) ? $entity->visita->created_at->format('d/m/Y H:i') : '--/--/--' }}</td>
                                            <td class="px-6 py-4">{{ isset($entity->visita) ? $entity->visita->data->format('d/m/Y') : '--/--/--' }}</td>
                                            <td class="px-6 py-4">{{ $entity->nomeResponsavel }}</td>
                                            <td class="px-6 py-4">{{ $entity->email }}</td>
                                            <td class="px-6 py-4">{{ $entity->motivo }}</td>
                                            <td class="px-6 py-4">{{ $entity->situacao->getDescription() }}</td>
                                            <td class="px-2 py-1">

                                                <button id='visualizar-{{ $entity->id }}' data-modal-target="visualizar-agendamento-{{$entity->id}}"
                                                    data-modal-toggle="visualizar-agendamento-{{$entity->id}}"
                                                    class="text-black hover:text-gray-600 mr-2"
                                                    type="button">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>

                                                @can('admin')

                                                    @if($entity->situacao == App\Models\Enums\Situacao::SITUACAO_PENDENTE)
                                                        <x-button-edit route="agendamentos.edit" :entity="$entity"/>
                                                    @endif

                                                    <x-button-remove route="agendamentos.destroy" :entity="$entity" />
                                                @endcannot

                                                @if ($entity->situacao == App\Models\Enums\Situacao::SITUACAO_PENDENTE)
                                                    <button id="dropdownMenuIconButton-{{ $entity->id }}" data-dropdown-toggle="dropdownDots-{{ $entity->id }}"
                                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                        type="button">
                                                        <svg class="w-5 h-5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 4 15">
                                                            <path
                                                                d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownDots-{{ $entity->id }}"
                                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownMenuIconButton-{{ $entity->id }}">

                                                            @cannot('visitante')
                                                                <li class="mr-2">
                                                                    <button id='aprovar-{{ $entity->id }}' data-modal-target="aprovar-agendamento-{{$entity->id}}"
                                                                        data-modal-toggle="aprovar-agendamento-{{$entity->id}}"
                                                                        class="text-white bg-green-500 hover:bg-green-600 p-1 rounded-md ml-2 w-full m-2"
                                                                        type="button">
                                                                        Aprovar
                                                                    </button>
                                                                </li>

                                                                <li class="mr-2">
                                                                    <button id='recusar-{{ $entity->id }}' data-modal-target="recusar-agendamento-{{$entity->id}}"
                                                                        data-modal-toggle="recusar-agendamento-{{$entity->id}}"
                                                                        class="text-white bg-orange-500 hover:bg-orange-600 p-1 rounded-md ml-2 w-full m-2"
                                                                        type="button">
                                                                        Recusar
                                                                    </button>
                                                                </li>
                                                            @endcannot

                                                            <li class="mr-2">
                                                                <button id='cancelar-{{ $entity->id }}' data-modal-target="cancelar-agendamento-{{$entity->id}}"
                                                                    data-modal-toggle="cancelar-agendamento-{{$entity->id}}"
                                                                    class="text-white bg-red-500 hover:bg-red-600 p-1 rounded-md ml-2 w-full m-2"
                                                                    type="button">
                                                                    Cancelar
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>

                                        @include('agendamento.modal-recusar', $entity)
                                        @include('agendamento.modal-aprovar', $entity)
                                        @include('agendamento.modal-cancelar', $entity)
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
