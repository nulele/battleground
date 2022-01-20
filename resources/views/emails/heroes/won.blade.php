@component('mail::message')
# Gentile {{ $hero->user->name }},

ti informiamo che il tuo eroe {{ $hero->fullname }} ha vinto un combattimento.


Buona giornata,<br>
{{ config('app.name') }}
@endcomponent
