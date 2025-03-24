<div class="grid grid-cols-10 gap-2">

    {{-- colocar em duas colunas --}}
    <div class="col-span-4 mb-4">
        <x-input-label for="nome" :value="__('Nome')" :required="true"/>
        <x-text-input  id="nome" name="nome" type="text" class="mt-1 block w-full" :value="$entity->nome ?? old('nome')"/>

        <x-input-error :messages="$errors->get('nome')" class="mt-1" />
    </div>

    <div class="col-span-3 mb-4">
        <x-input-label for="apelido" :value="__('Apelido')" />
        <x-text-input  id="apelido" name="apelido" type="text" class="mt-1 block w-full" :value="$entity->apelido ?? old('apelido')"/>

        <x-input-error :messages="$errors->get('apelido')" class="mt-1" />
    </div>

    <div class="col-span-3 mb-4">
        <x-input-label for="email" :value="__('E-mail')" :required="true"/>
        <x-text-input  id="email" name="email" type="email" class="mt-1 block w-full" :value="$entity->email ?? old('email')"/>

        <x-input-error :messages="$errors->get('email')" class="mt-1" />
    </div>


</div>

<div class="grid grid-cols-11 gap-2">
    <div class="col-span-3 mb-4">
        <x-input-label for="linguasEstrangeiras" :value="__('Línguas estrangeiras')" :required="true"/>
        <x-text-input  id="linguasEstrangeiras" name="linguasEstrangeiras" type="text" class="mt-1 block w-full" :value="$entity->linguasEstrangeiras ?? old('linguasEstrangeiras')"/>

        <x-input-error :messages="$errors->get('linguasEstrangeiras')" class="mt-1" />
    </div>

    {{-- Criar um campo select e injetar a enumeração --}}
    <div class="col-span-2 mb-4">
        <x-input-label for="escolaridade" :value="__('Escolaridade')" :required="true"/>
        <select id="escolaridade" name="escolaridade" class="mt-1 py-2.5 p-block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @if (isset($entity->escolaridade))
                <option value="{{$entity->escolaridade->value}}">
                    {{ $entity->escolaridade->getDescription() }}
                </option>

            @else
                <option value="{{  old('escolaridade') ?  old('escolaridade') : ''}}">{{  old('escolaridade') ? \App\Models\Enums\Escolaridade::get( old('escolaridade')) : 'Selecione uma escolaridade'}}</option>
            @endif

            @foreach (\App\Models\Enums\Escolaridade::cases() as $escolaridade)
                <option value="{{ $escolaridade->value }}">{{ $escolaridade->getDescription() }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-span-3 mb-4">
        <x-input-label for="instagram" :value="__('Instagram')" />
        <x-text-input  id="instagram" name="instagram" type="text" class="mt-1 block w-full" :value="$entity->instagram ??  old('instagram')"/>

        <x-input-error :messages="$errors->get('instagram')" class="mt-1" />
    </div>

    <div class="col-span-3 mb-4">
        <x-input-label for="facebook" :value="__('Facebook')" />
        <x-text-input  id="facebook" name="facebook" type="text" class="mt-1 block w-full" :value="$entity->facebook ?? old('facebook')"/>

        <x-input-error :messages="$errors->get('facebook')" class="mt-1" />
    </div>
</div>

<div class="grid">
    <div class=" mb-4">
        <x-input-label for="informacoes" :value="__('Informações')" />
        <textarea rows="2" cols="50"  id="informacoes" name="informacoes" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$entity->informacoes ?? old('informacoes')}}"></textarea>

        <x-input-error :messages="$errors->get('informacoes')" class="mt-1" />
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
        <x-input-label for="numero" :value="__('Número')" :required="true"/>
        <x-text-input  id="numero" name="numero" type="text" class="mt-1 block w-full telefone" :value="isset($entity->telefones) ? $entity->telefones()->first()->numero : old('numero')"/>
        <x-input-error :messages="$errors->get('numero')" class="mt-1" />
    </div>
</div>

<h2>Endereço</h2>
<div class="grid grid-cols-10 gap-2">

    <div class="mb-4 col-span-3">
        <x-input-label for="cep" :value="__('Cep')" :required="true"/>
        <x-text-input  id="cep" name="cep" type="text" class="mt-1 block w-full cep" :value="$entity->localidade->cep ?? old('cep')"/>
        <x-input-error :messages="$errors->get('cep')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-1">
        <x-input-label for="uf" :value="__('UF')" :required="true"/>
        <x-text-input  id="uf" name="uf" type="text" class="mt-1 block w-full" :value="$entity->localidade->uf ?? old('uf')"/>
        <x-input-error :messages="$errors->get('uf')" class="mt-1" />
    </div>
    <div class="mb-4 col-span-3">
        <x-input-label for="cidade" :value="__('Cidade')" :required="true"/>
        <x-text-input  id="cidade" name="cidade" type="text" class="mt-1 block w-full" :value="$entity->localidade->cidade ?? old('cidade')"/>
        <x-input-error :messages="$errors->get('cidade')" class="mt-1" />
    </div>

    <div class="mb-4 col-span-3">
        <x-input-label for="pais" :value="__('País')" :required="true"/>
        <select id="pais" name="pais" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            @if(empty($entity->localidade->pais))
                <option value="Brasil" selected>Brasil</option>
            @else
                <option value="{{$entity->localidade->pais}}" selected>{{$entity->localidade->pais}}</option>
            @endif
        </select>
    </div>
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Salvar') }}
    </x-primary-button>
</div>
