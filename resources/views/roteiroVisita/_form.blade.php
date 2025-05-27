<h1 class="text-lg my-4 text-center dark:text-white">Selecione os roteiros <span class="text-red-500">*</span></h1>

@php($roteirosDisponiveis = $roteiros->where('vagas_disponiveis', '>', 0)->count())
    @foreach ($roteiros as $roteiro)
        @if($roteiro->vagas_disponiveis > 0)
            <div class="flex items-center mb-4">
                <input id="roteiro-checkbox-{{ $roteiro->id }}" name="roteiros[]" type="checkbox" value="{{ $roteiro->id }}"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    {{ in_array($roteiro->id, $visita->roteiros->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label for="roteiro-checkbox-{{ $roteiro->id }}"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $roteiro->nome }}</label>
            </div>
        @endif
    @endforeach
    @if (!$roteirosDisponiveis)
    <div class="flex items-center mb-4">
        <label for="roteiro-checkbox-0"
            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nenhum roteiro disponível para a data selecionada.</label>
    </div>
    @endif

<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Próximo passo') }}
    </x-primary-button>
</div>
