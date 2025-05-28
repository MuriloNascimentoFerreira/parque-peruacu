<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{ __('messages.condutores') }}" route="condutores.create" />
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
                                        <th scope="col" class="px-3 py-3">Nome</th>
                                        <th scope="col" class="px-3 py-3">Apelido</th>
                                        <th scope="col" class="px-3 py-3">Telefone</th>
                                        <th scope="col" class="px-3 py-3">Localidade</th>
                                        <th scope="col" class="px-3 py-3">Línguas Estrangeiras</th>
                                        <th scope="col" class="px-3 py-3">Escolaridade</th>
                                        <th scope="col" class="px-1 py-1">Ações</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entities as $entity)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                <button class="text-blue-500 hover:text-blue-600 hover:underline"
                                                    data-modal-target="visualizar-condutor-{{ $entity->id }}"
                                                    data-modal-toggle="visualizar-condutor-{{ $entity->id }}">
                                                    {{ $entity->id }}
                                                </button>
                                            </td>
                                            <td class="px-6 py-4">{{ $entity->nome }}</td>
                                            <td class="px-6 py-4">{{ $entity->apelido }}</td>
                                            <td class="px-6 py-4">
                                                {{ $entity->telefones()->first()->descricao }}-
                                                {{ $entity->telefones()->first()->numero }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $entity->localidade->cidade }}-{{ $entity->localidade->uf }}</td>
                                            <td class="px-6 py-4">{{ $entity->linguasEstrangeiras }}</td>
                                            <td class="px-6 py-4">{{ $entity->escolaridade->getDescription() }}</td>

                                            <td class="px-2 py-1">

                                                <button data-modal-target="visualizar-condutor-{{ $entity->id }}"
                                                    data-modal-toggle="visualizar-condutor-{{ $entity->id }}"
                                                    class="text-black hover:text-gray-600 mr-2" type="button">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>

                                                <x-button-edit route="condutores.edit" :entity="$entity" />

                                                <x-button-remove route="condutores.destroy" :entity="$entity" />

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
                                                        <li>
                                                            <button data-modal-target="habilitar-condutor-{{ $entity->id }}"
                                                                data-modal-toggle="habilitar-condutor-{{ $entity->id }}"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">
                                                                <i class="fa-solid fa-road-circle-check"></i> Habilitar roteiros
                                                            </button>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </td>

                                        </tr>

                                        @include('condutor.modal-show', $entity)
                                        @include('condutor.modal-habilitar', ['entity' => $entity, 'roteiros' => $roteiros])
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $entities->links() !!}
                        </div>
                    @else
                        <div>Sem condutores cadastrados </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
