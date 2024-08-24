<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('messages.roteiros') }}
                </h2>
            </div>
            <div class="text-end p-2">
                <a href="{{route('roteiros.create')}}" class="inline-flex items-center justify-center w-10 h-10 bg-blue-500 rounded-full text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- adicionar listagem com botão de adicionar na listagem ter botão de editar e remover --}}

                    @if ($entities->count())

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
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
                                            <td class="px-6 py-4">{{$entity->nome}}</td>
                                            <td class="px-6 py-4">{{$entity->lotacao}}</td>
                                            <td class="px-6 py-4">{{$entity->duracao}} min</td>
                                            <td class="px-6 py-4">{{$entity->nivel->getDescription()}}</td>
                                            <td class="px-6 py-4">{{$entity->distancia}} km</td>
                                            <td class="px-2 py-1">
                                                <a href="{{ route('roteiros.edit', $entity)}}" class="hover:text-blue-600 mr-2">
                                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                                </a>

                                                {{-- Criar formulário para confirmar exclusão --}}
                                                <form action="{{ route('roteiros.destroy', $entity) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:text-red-600" >
                                                        <i class="fa-solid fa-trash-can fa-lg">
                                                        </i>
                                                    </button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {!! $entities->links() !!} --}}
                        </div>
                    @else
                        <div> sem roteiros cadastrados </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
