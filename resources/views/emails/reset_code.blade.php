<x-mail::message>
# Code de réinitialisation

Voici votre code de réinitialisation :

<x-mail::panel>
   {{ $reset_code }}
</x-mail::panel>

{{ config('app.name') }}
</x-mail::message>