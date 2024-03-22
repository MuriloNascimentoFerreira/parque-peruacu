<x-mail::message>
    # Magic Login Link

    Use the link below to log into the app

    <x-mail::button :url="$url">
        Login

    </x-mail::button>

    Thanks, <br/>
    {{ config('app.name')}}

</x-mail::message>




