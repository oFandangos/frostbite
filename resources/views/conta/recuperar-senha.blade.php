@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/recuperar">
                        @csrf
                        <label for="email">Email</label>
                        <input type="email" name="email" class="input" value="{{old('email')}}" placeholder="Insira seu email">
                        <button type="submit" class="enviar" style="margin-top:10px; width:100%; padding:10px;">Enviar</button>                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:5px;
            border:1px solid rgb(10, 179, 38);
            border-radius:2px;
            outline:none;
        }

        .enviar{
            background-color:rgb(10, 179, 38);
            outline:none;
            border:1px solid rgb(10, 179, 38);
            border-radius:2px;
            color:white;
        }

    </style>

@endsection