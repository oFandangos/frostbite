Prezado {{$email->name}}, <br/>

confirme seu email clicando aqui: <a href="{{ URL::signedRoute('email.confirmado', ['id' => $email->id ]) }}" target="_blank">Confirmar email</a>