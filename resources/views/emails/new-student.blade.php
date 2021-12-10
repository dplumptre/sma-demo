@component('mail::message')

Hello {{$name}}, <br><br>

<p>Congrats you are welcome to {{$classroom}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
