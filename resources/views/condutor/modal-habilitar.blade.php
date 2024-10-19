<!-- Main modal -->
<div id="habilitar-condutor-{{$entity->id}}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{__('messages.condutor')}}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="habilitar-condutor-{{$entity->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-2">
                <form method="POST" action="{{ route('condutores.habilitar-condutores', $entity) }}" >
                    @csrf
                    @foreach ($roteiros as $roteiro)
                        <div class="flex items-center mb-4">
                            <input id="roteiro-checkbox-{{$roteiro->id}}" name="roteiros[]" type="checkbox" value="{{$roteiro->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{in_array($roteiro->id, $entity->roteiros->pluck('id')->toArray()) ? 'checked' : ''}}>
                            <label for="roteiro-checkbox-{{$roteiro->id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$roteiro->nome}}</label>
                        </div>
                    @endforeach

                    <div class="flex justify-end">
                        <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-end dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Habilitar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
