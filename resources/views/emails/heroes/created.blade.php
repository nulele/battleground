@component('mail::message')
# Gentile {{ $hero->user->name }},

ti informiamo che il tuo eroe {{ $hero->fullname }} è stato creato.


Buona giornata,<br>
{{ config('app.name') }}
@endcomponent
