<div class="grid grid-cols-3 gap-2">

    <div class="mb-4 col-span-2">
        <x-input-label for="nomeResponsavel" :value="__('Nome do responsável')" />
        <x-text-input  id="nomeResponsavel" name="nomeResponsavel" type="text" class="mt-1 block w-full" :value="$entity->nomeResponsavel ?? old('nomeResponsavel')"/>

        <x-input-error :messages="$errors->get('nomeResponsavel')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-1">
        <x-input-label for="email" :value="__('E-mail')" />
        <x-text-input  id="email" name="email" type="email" class="mt-1 block w-full" :value="$entity->email ?? old('email')"/>

        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>

    {{-- colocar em duas colunas --}}
    <div class="mb-4 col-span-4">
        <x-input-label for="motivo" :value="__('Motivo')" />
        <x-text-input  id="motivo" name="motivo" type="text" class="mt-1 block w-full" :value="$entity->motivo ?? old('motivo')"/>
            <x-input-error :messages="$errors->get('motivo')" class="mt-1" />
    </div>
</div>

<h2>Localidade do responsável</h2>
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

{{-- <input type="hidden" name="visita" value="{{isset($visita->id) ? $visita->id : $entity->visita->id}}"> --}}
<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Próximo') }}
    </x-primary-button>
</div>
