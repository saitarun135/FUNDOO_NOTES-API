
@component('mail::message')
Hai ,
<br>
{{$email}}
<br>
This is your resetToken
{{$token}}
<br>
Do not share it with any one..!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
