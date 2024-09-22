<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{__('messages.roteiros')}}" route="roteiros.create" />
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
                                        <th scope="col" class="px-3 py-3">Nome</th>
                                        <th scope="col" class="px-3 py-3">Lotação</th>
                                        <th scope="col" class="px-3 py-3">Duração</th>
                                        <th scope="col" class="px-3 py-3">Nível</th>
                                        <th scope="col" class="px-3 py-3">Distância</th>
                                        <th scope="col" class="px-1 py-1">Ações</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entities as $entity)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">{{$entity->id}}</td>
                                            <td class="px-6 py-4">{{$entity->nome}}</td>
                                            <td class="px-6 py-4">{{$entity->lotacao}}</td>
                                            <td class="px-6 py-4">{{$entity->duracao}} min</td>
                                            <td class="px-6 py-4">{{$entity->nivel->getDescription()}}</td>
                                            <td class="px-6 py-4">{{$entity->distancia}} km</td>
                                            <td class="px-2 py-1">

                                                <x-button-edit route="roteiros.edit" :entity="$entity"/>

                                                <x-button-remove route="roteiros.destroy" :entity="$entity"/>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $entities->links() !!}
                        </div>
                    @else
                        <div> sem roteiros cadastrados </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
