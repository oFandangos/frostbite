@extends('laravel-usp-theme::master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/login">
                        @csrf
                        <label for="name">Número de usuário</label>
                        <input type="text" name="codpes" class="input" value="{{old('codpes')}}">
                        <label for="password">Senha</label>
                        <input type="password" name="password" name="password" class="input">
                        <div class="row">
                            <div class="col-10">
                                <a id="rec" href="/recuperar-senha" style="margin-top:10px;">Esqueceu a senha?</a>
                            </div>
                            <div class="col-g">
                                <a id="rec" href="cadastrar">Cadastrar-se</a>
                            </div>
                        </div>
                        <button type="submit" class="enviar" style="margin-top:10px; width:100%; padding:10px;">Enviar</button>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="/" class="btn btn-outline-primary">Voltar</a>

<style>

    #rec{
        font-size:12px;
    }

    .enviar{
        background-color:rgb(10, 179, 38);
        outline:none;
        border:1px solid rgb(10, 179, 38);
        border-radius:2px;
        color:white;
    }

    .enviar:hover{
        background-color:white;
        border:1px solid rgb(10, 179, 38);
        color:white;
        animation:color;
        animation-timing-function:ease;
        animation-duration:.1s;
        color:rgb(10, 179, 38);
    }
    

    @keyframes color{
        from{
            background-color:rgb(10, 179, 38);
        }
        to{
            background-color:white;
        }
    }

    .card{
        border:none;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label{
        display:grid;
        font-size:16px;
        font-weight:600;
        margin-top:10px;
        text-align:center;
    }

    .input{
        display:flex;
        flex-wrap:wrap;
        flex-direction:column;
        width:100%;
        padding:4px;
        border-bottom:1px solid black;
        border-top:0px;
        border-left:0px;
        border-right:0px;
    }
    @keyframes teste{
        from{
            border-bottom:1px solid black;
            border-top:0px;
            border-left:0px;
            border-right:0px;
        }
        to{
            border-top:0px;
            border-left:0px;
            border-right:0px;
            border-bottom:1px solid blue;
        }
    }
    
    .input:focus{
        outline:none;
        animation-name: teste;
        animation-duration: .2s;
        animation-timing-function: ease-in;
        border-top:0px;
        border-left:0px;
        border-right:0px;
        border-bottom:1px solid blue;
    }


</style>

@endsection