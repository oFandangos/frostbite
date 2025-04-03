@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Editar Nome da Categoria</h4>
                    <form method="post" action="/cat/{{$category->id}}/edit">
                    @method("put")
                    @csrf
                    <input type="text" name="nome_cat" value="{{old('nome_cat', $category->nome_cat)}}" class="form-control">
                    <button type="submit" class="btn btn-success" style="width:100%; margin-top:10px; padding:10px;">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .footer-fflch{
        position:fixed;
        bottom:0;
        width:100%;
    }
</style>