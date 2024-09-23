<x-app-layout>
    <x-slot name="header">
        <x-views-header title="{{__('messages.condutores')}}" route="condutores.create" />
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
                                        <th scope="col" class="px-3 py-3">Apelido</th>
                                        <th scope="col" class="px-3 py-3">E-mail</th>
                                        <th scope="col" class="px-3 py-3">Localidade</th>
                                        <th scope="col" class="px-3 py-3">Línguas Estrangeiras</th>
                                        <th scope="col" class="px-3 py-3">Escolaridade</th>
                                        <th scope="col" class="px-3 py-3">Instagram</th>
                                        <th scope="col" class="px-3 py-3">Facebook</th>
                                        <th scope="col" class="px-3 py-3">Informações</th>
                                        <th scope="col" class="px-1 py-1">Ações</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entities as $entity)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">{{$entity->id}}</td>
                                            <td class="px-6 py-4">{{$entity->nome}}</td>
                                            <td class="px-6 py-4">{{$entity->apelido}}</td>
                                            <td class="px-6 py-4">{{$entity->email}}</td>
                                            <td class="px-6 py-4">{{$entity->localidade}}</td>
                                            <td class="px-6 py-4">{{$entity->linguasEstrangeiras}}</td>
                                            <td class="px-6 py-4">{{$entity->escolaridade->getDescription()}}</td>
                                            <td class="px-6 py-4">{{$entity->instagram}}</td>
                                            <td class="px-6 py-4">{{$entity->facebook}}</td>
                                            <td class="px-6 py-4">{{$entity->informacoes}}</td>

                                            <td class="px-2 py-1">

                                                <x-button-edit route="condutores.edit" :entity="$entity"/>

                                                <x-button-remove route="condutores.destroy" :entity="$entity"/>

                                            </td>

                                        </tr>
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
