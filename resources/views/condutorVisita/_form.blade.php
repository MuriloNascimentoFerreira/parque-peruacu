<h1 class="text-lg my-4 text-center">Selecione os condutores</h1>

@foreach ($condutores as $condutor)
    <div class="flex items-center mb-4">
        <input id="condutor-checkbox-{{ $condutor->id }}" name="condutores[]" type="checkbox" value="{{ $condutor->id }}"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            {{ in_array($condutor->id, $visita->condutores->pluck('id')->toArray()) ? 'checked' : '' }}>
        <label for="condutor-checkbox-{{ $condutor->id }}"
            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $condutor->nome }} ({{$condutor->roteiros->pluck('nome')->implode(', ')}})</label>
    </div>
@endforeach
<x-input-error :messages="$errors->get('condutores')" class="mt-1" />


<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Salvar') }}
    </x-primary-button>
</div>
