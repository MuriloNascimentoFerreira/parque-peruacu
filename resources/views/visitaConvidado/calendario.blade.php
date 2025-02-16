<x-app-layout>
  {{--   <x-slot name="header">
        <x-views-header title="{{__('messages.visitas')}}"/>
    </x-slot> --}}

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('errors._alerts')


            <div id="calendar" class="px-14">

            </div>
        </div>
    </div>

</x-app-layout>
