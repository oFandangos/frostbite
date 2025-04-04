@php

$email = \App\Models\User::where('email_verified_at', null)
    ->first();

@endphp

confirme seu email clicando aqui: <a href="http://127.0.0.1:8000/email_verificado/{{$email->id}}" target="_blank" value="{{now()}}">Confirmar email</a>