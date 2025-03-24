<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{ __('messages.configVisita') }}" />
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('errors._alerts')
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 pb-72">
                <div class="relative">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-3 py-3">Número de visitantes por condutor:</th>
                                <td class="text-end">
                                    <span class="pr-3">{{ $configVisita->visitantes_por_condutor }}</span>

                                    <button data-modal-target="modal-edit-visitantes-por-condutor"
                                        data-modal-toggle="modal-edit-visitantes-por-condutor"
                                        class="text-blue-500 hover:text-blue-600 mr-2" type="button">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('configVisita.modal-edit-visitantes-por-condutor', ['entity' => $configVisita])

</x-app-layout>
