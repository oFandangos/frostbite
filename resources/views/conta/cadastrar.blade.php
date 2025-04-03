@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/store">
                        @csrf
                        <div class="row">
                            <label>E-mail</label>
                            <input type="email" class="input" name="email" value="{{old('email')}}">
                        </div>
                        <div class="row">
                            <label>Número de usuário</label>
                            <input type="text" class="input" name="codpes" value="{{old('codpes')}}">
                        </div>
                        <div class="row">
                            <label>Nome de usuário</label>
                            <input type="text" class="input" name="name" value="{{old('name')}}">
                        </div>
                        <div class="row">
                            <label>Senha</label>
                            <input class="input" name="password" type="password" value="{{old('password')}}">
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" class="checkbox" value="1">
                                <label id="letter" >Quero receber letters por email *-*</label>
                            </div>
                        </div>
                        <div class="row">
                            <button class="cadastro">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-body{
        padding:2.4rem;
    }
    label{
        margin-bottom:-.2rem;
        margin-top:1rem;
        font-weight:bold;
    }
    #letter{
        font-weight:normal;
        font-size:8px;
    }
    .checkbox{
        width:12px;
        height:12px;
    }
    .input{
        width:100%;
        padding:8px;
        margin-top:5px;
        border-top: 0px;
        border-left:0px;
        border-right:0px;
        border-bottom:1px solid gray;
        transition:0.2s;
    }
    .input:focus{
        outline:none;
        border-bottom:4px solid rgb(11, 135, 19);
    }

    .cadastro{
        padding:8px;
        outline:none;
        border:1px solid rgb(11, 135, 19);
        background-color:rgb(11, 135, 19);
        border-radius:4px;
        width:100%;
        color:white;
        margin-top:20px;
        transition:0.2s;
    }

    .cadastro:hover{
        background-color:transparent;
        color:rgb(11, 135, 19);

    }

</style>

@endsection