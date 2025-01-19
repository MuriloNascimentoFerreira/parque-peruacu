<!-- Main modal -->
<div id="visualizar-agendamento-{{$entity->id}}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{__('messages.agendamento')}}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="visualizar-agendamento-{{$entity->id}}">
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
                <div class="text-center">Informações do agendamento</div>
                <div><strong>Data:</strong> {{$entity->visita->data->format('d/m/Y')}}</div>
                <div><strong>Situação:</strong> {{$entity->situacao->getDescription()}}</div>
                <div><strong>Motivo:</strong> {{$entity->motivo}}</div>
                <div class="text-center">Responsável pelo agendamento</div>
                <div><strong>Responsável:</strong> {{$entity->nomeResponsavel}}</div>
                <div><strong>E-mail:</strong> {{$entity->email}}</div>
                <div><strong>Telefone:</strong> {{$entity->telefones && $entity->telefones()->first()->descricao ? $entity->telefones()->first()->descricao.' - ':''}}{{$entity->telefones()->first()->numero}}</div>
                <div><strong>Cep:</strong> {{$entity->localidade->cep}}</div>
                <div><strong>Cidade:</strong> {{$entity->localidade->cidade}}</div>
                <div><strong>UF:</strong> {{$entity->localidade->uf}}</div>
                <div><strong>País:</strong> {{$entity->localidade->pais}}</div>
            </div>
        </div>
    </div>
</div>
