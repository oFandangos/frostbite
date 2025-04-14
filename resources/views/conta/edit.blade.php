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
                        <div class="row">
                            <div class="col">
                                <label>Nome</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" >
                            </div>
                            <div class="col">
                                <label>E-mail</label>
                                <input type="text" name="email" value="{{auth()->user()->email}}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Código de usuário</label>
                                <input type="text" name="codpes" value="{{auth()->user()->codpes}}" >
                            </div>
                            <div class="col">
                                <label>Nova Senha</label>
                                <input type="password" name="password">
                                <i class="fas fa-eye" onClick="showPassword()" id="eye1"></i>
                            </div>
                            <div class="col">
                                <label>Repita sua nova senha</label>
                                <input type="password" name="password_confirmation" >
                                <i class="fas fa-eye" onClick="showPasswordConfirmation()" id="eye2"></i>
                            </div>
                        </div>
                        <button type="submit" class="alterar">Alterar</button>
                    </div>
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

<style>
    .col{
        margin:8px;
    }

    label{
        display:flex;
        flex-direction:column;
        flex-wrap:wrap;
    }
    input{
        border-top:0;
        border-left:0;
        border-right:0;
        border-bottom:1px solid #000;
        width:100%;
        transition:.1s;
    }
    input:focus{
        outline:none;
        border-bottom:2px solid rgb(38, 192,11);
    }

    .testando{
        width:100px !important;
    }

    .alterar{
        margin-top:8px;
        width:100%;
        padding:6px;
        background-color:transparent;
        color: rgb(38, 192, 11);
        border: 2px solid rgb(38, 192, 11);
        transition:.2s;
        border-radius:5px;
    }
    .alterar:hover{
        background-color:rgb(38, 192, 11);
        color:white;
        border: 2px solid rgb(38, 192, 11);
        cursor:pointer;
    }
</style>


@endsection