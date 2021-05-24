
@component('mail::message')
Hello ,
<br>
{{-- This is your resetToken --}}
{{-- {{$token}} --}}
{{-- <br> --}}
 click here to change your  <a href="http://localhost:3000/reset/{{$token}}">password</a> 

Do not share it with any one..!
{{$email}}
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
