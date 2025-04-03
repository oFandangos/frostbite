@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/adm/avisos/create">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Titulo do aviso</label>
                            <input name="titulo" value="{{old('titulo')}}" type="text" placeholder="Insira o titulo do aviso" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea name="texto" value="{{old('texto')}}" class="form-control" placeholder="Insira o aviso"></textarea>
                        </div>
                        <input type="hidden" name="user_aviso_id" value="{{$user->id}}">
                        <button type="submit" class="btn btn-success" style="width:100%; padding:8px;">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection