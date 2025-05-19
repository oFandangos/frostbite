@extends('menu.menu')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="/conta/{{auth()->user()->id}}">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <h4>{{ Auth::user()->name }}</h4>
                        <hr/>
                        <div class="form-floating-group">
                            <input class="input" name="name" placeholder=" " value="{{ old('name', $user->name) }}">
                            <label for="name">Nome</label>
                        </div>
                        <div class="form-floating-group">
                            <input class="input" name="email" placeholder=" " value="{{ old('email', $user->email)}}">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="form-floating-group">
                            <input class="input" name="codpes" placeholder=" " value="{{ old('codpes', $user->codpes)}}">
                            <label for="codpes">Código de usuário</label>
                        </div>
                        <div class="form-floating-group">
                            <input class="input" name="password" type="password" placeholder=" ">
                            <label for="password">Senha</label>
                            <i class="fas fa-eye" onClick="showPassword()" id="eye1"></i>
                        </div>
                        <div class="form-floating-group">
                            <input class="input" name="password_confirmation" type="password" placeholder=" ">
                            <label for="password_confirmation">Confirme sua senha</label>
                            <i class="fas fa-eye" onClick="showPasswordConfirmation()" id="eye2"></i>
                        </div>
                        <button type="submit" class="comprar">Alterar</button>
                    </div>
                    <a href="/conta/" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showPassword(){
        let input = document.querySelector('input[name="password"]');
        let i = document.getElementById('eye1');
        if(input.type === "text"){
            input.type = "password";
            i.classList.add('fa-eye');
        }else{
            input.type = "text";
            i.classList.add('fa-eye-slash');
        }
    }

    function showPasswordConfirmation(){
        let input = document.querySelector('input[name="password_confirmation"]');
        let i2 = document.getElementById('eye2');
        if(input.type === "text"){
            input.type = "password";
            i2.classList.add('fa-eye');
        }else{
            input.type = "text";
            i2.classList.add('fa-eye-slash');
        }
    }

</script>

@endsection