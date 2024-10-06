<div class="grid">

    <div class="relative mb-4">
        <x-input-label for="data" :value="__('Data')" />
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none mt-4">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
        <input datepickerselect name="data" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecione a data" autocomplete="off" value="{{$entity->data->format('d/m/Y') ?? old('data')}}">
        <x-input-error :messages="$errors->get('data')" class="mt-1" />

    </div>

    <div class="mb-4">
        <x-input-label for="quantidadePessoas" :value="__('Quantidade pessoas')" />
        <x-text-input  id="quantidade-pessoas" name="quantidadePessoas" type="number" class="mt-1 block w-full inteiro" :value="$entity->quantidadePessoas ?? null"/>

        <x-input-error :messages="$errors->get('quantidadePessoas')" class="mt-1" />
    </div>

    <div class="mb-4">
        <x-input-label for="quantidadePessoasEfetivo" :value="__('Quantidade pessoas efetivo')" />
        <x-text-input  id="quantidade-pessoas-efetivo" name="quantidadePessoasEfetivo" type="number" class="mt-1 block w-full inteiro" :value="$entity->quantidadePessoasEfetivo ?? null"/>

        <x-input-error :messages="$errors->get('quantidadePessoasEfetivo')" class="mt-1" />
    </div>

    {{-- Criar um campo select e injetar a enumeração --}}
    <div class="mb-4">
        <x-input-label for="periodo" :value="__('Período')" />
        <select id="periodo" name="periodo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            <option value="{{ isset($entity->periodo) ? $entity->periodo->value : ''}}">{{ isset($entity->periodo) ? $entity->periodo->getDescription() : 'Selecione um período'}}</option>
            @foreach (\App\Models\Enums\Periodo::cases() as $periodo)
                <option value="{{ $periodo->value }}">{{ $periodo->getDescription() }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Salvar') }}
    </x-primary-button>
</div>
