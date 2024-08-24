<div class="grid grid-cols-2 gap-6">
    <div>
        <x-input-label for="nome" :value="__('Nome')" />
        <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full"  :value="$entity->nome ?? null" required autofocus />

        <x-input-error :messages="$errors->get('nome')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="lotacao" :value="__('Lotação')" />
        <x-text-input  id="lotacao" name="lotacao" type="text" class="mt-1 block w-full inteiro" :value="$entity->lotacao ?? null"/>

        <x-input-error :messages="$errors->get('lotacao')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="duracao" :value="__('Duração')"/>

        <div class="flex items-center">
            <div class="relative mr-4 w-full">
                <select id="horas" name="horas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="{{$entity->horas ?? ''}}">{{$entity->horas ?? 'Horas'}}</option>
                    @for ($i = 0; $i <= 23; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="relative w-full">
                <select id="minutos" name="minutos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                    <option value="{{$entity->minutos ?? ''}}">{{$entity->minutos ?? 'Minutos'}}</option>
                    @for ($i = 0; $i <= 59; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    {{-- Criar um campo select e injetar a enumeração --}}
    <div>
        <x-input-label for="nivel" :value="__('Nível')" />
        <select id="nivel" name="nivel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            <option value="{{ $entity->nivel->value ?? ''}}">{{ $entity->nivel->getDescription() ?? 'Selecione um nível'}}</option>
            @foreach (\App\Models\Enums\Niveis::cases() as $nivel)
                <option value="{{ $nivel->value }}">{{ $nivel->getDescription() }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="distancia" :value="__('Distância')" />
        <div class="relative">
            <x-text-input id="distancia" name="distancia" type="text" class="mt-1 block w-full kilometros" :value="$entity->distancia ?? null" required placeholder="0,0" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                Km
            </span>
            <x-input-error :messages="$errors->get('distancia')" class="mt-1" />
        </div>
    </div>
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button class="ml-3">
        {{ __('Salvar') }}
    </x-primary-button>
</div>
