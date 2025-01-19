
{{-- colocar em duas colunas --}}
<div class="grid grid-cols-8 gap-2">

    <div class="mb-4 col-span-3">
        <x-input-label for="nomeResponsavel" :value="__('Nome do responsável')" />
        <x-text-input  id="nomeResponsavel" name="nomeResponsavel" type="text" class="mt-1 block w-full" :value="$entity->nomeResponsavel ?? old('nomeResponsavel')"/>

        <x-input-error :messages="$errors->get('nomeResponsavel')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-2">
        <x-input-label for="email" :value="__('E-mail')" />
        <x-text-input  id="email" name="email" type="email" class="mt-1 block w-full" :value="$entity->email ?? old('email')"/>

        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-3">
        <x-input-label for="motivo" :value="__('Motivo da visita')" />
        <x-text-input  id="motivo" name="motivo" type="text" class="mt-1 block w-full" :value="$entity->motivo ?? old('motivo')"/>
            <x-input-error :messages="$errors->get('motivo')" class="mt-1" />
    </div>
</div>

<div class="grid grid-cols-8 gap-2">

    {{-- <div class="mb-4 col-span-2">
        <div class="relative mb-4">
            <x-input-label for="data" :value="__('Data do agendamento')" />
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none mt-4">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input datepickerselect name="data" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecione a data" autocomplete="off" value="{{isset($entity->data) ? $entity->data->format('d/m/Y') :  old('data')}}">
        </div>
        <x-input-error :messages="$errors->get('data')" />
    </div> --}}

    {{-- Criar um campo select e injetar a enumeração --}}
    {{-- <div class="mb-4 col-span-2">
        <x-input-label for="situacao" :value="__('Situação')" />
        <select id="situacao" name="situacao" class="mt-1 py-2.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @if (isset($entity->situacao))
            <option value="{{$entity->situacao->value}}">
                {{ $entity->situacao->getDescription() }}
            </option>
            @else
            <option value="{{  old('situacao') ?  old('situacao') : '1'}}">{{  old('situacao') ? \App\Models\Enums\Situacao::get( old('situacao')) : 'Pendente'}}</option>
            @endif
            @foreach (\App\Models\Enums\Situacao::cases() as $situacao)
            <option value="{{ $situacao->value }}">{{ $situacao->getDescription() }}</option>
            @endforeach
        </select>
    </div> --}}
</div>

<h2 class="text-center">Localidade do responsável</h2>
<div class="grid grid-cols-10 gap-2">

    <div class="mb-4 col-span-3">
        <x-input-label for="cep" :value="__('Cep')" />
        <x-text-input  id="cep" name="cep" type="text" class="mt-1 block w-full cep" :value="$entity->localidade->cep ?? old('cep')"/>
        <x-input-error :messages="$errors->get('cep')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-1">
        <x-input-label for="uf" :value="__('UF')" />
        <x-text-input  id="uf" name="uf" type="text" class="mt-1 block w-full" :value="$entity->localidade->uf ?? old('uf')"/>
        <x-input-error :messages="$errors->get('uf')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-3">
        <x-input-label for="cidade" :value="__('Cidade')" />
        <x-text-input  id="cidade" name="cidade" type="text" class="mt-1 block w-full" :value="$entity->localidade->cidade ?? old('cidade')"/>
        <x-input-error :messages="$errors->get('cidade')" class="mt-1" />
    </div>

    <div class="mb-4 col-span-3">
        <x-input-label for="pais" :value="__('País')" />
        <select id="pais" name="pais" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @if(empty($entity->localidade->pais))
                <option value="Brasil" selected>Brasil</option>
            @else
                <option value="{{$entity->localidade->pais}}" selected>{{$entity->localidade->pais}}</option>
            @endif
        </select>
    </div>
</div>

<h2>Telefone</h2>
<div class="grid grid-cols-2 gap-2">
    <div class="mb-4">
        <x-input-label for="descricao" :value="__('Descrição')" />
        <x-text-input  id="descricao" name="descricao" type="text" class="mt-1 block w-full" :value="isset($entity->telefones) ? $entity->telefones()->first()->descricao : old('descricao')"/>
        <x-input-error :messages="$errors->get('descricao')" class="mt-1" />
    </div>
    <div class="mb-4">
        <x-input-label for="numero" :value="__('Número')" />
        <x-text-input  id="numero" name="numero" type="text" class="mt-1 block w-full telefone" :value="isset($entity->telefones) ? $entity->telefones()->first()->numero : old('numero')"/>
        <x-input-error :messages="$errors->get('numero')" class="mt-1" />
    </div>
</div>

<input type="hidden" name="visita" value="{{isset($entity) ? $entity->visita->id : $visita->id}}">

<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Confirmar agendamento') }}
    </x-primary-button>
</div>
