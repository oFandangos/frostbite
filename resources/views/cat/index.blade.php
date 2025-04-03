@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')
<a href="/cat/create" class="btn btn-success">Cadastar categorias</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @forelse($categories as $category)
                    <p class="text-center">{{$category->nome_cat}}</p>
                    <a href="/cat/edit/{{$category->id}}" class="btn btn-primary">Editar</a>
                    <form method="post" action="/cat/{{$category->id}}">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                    <hr>
                    @empty
                    <p class="text-center text-danger">Não há Categorias cadastradas</p>
                @endforelse
                </div>
            </div>
            <a href="/user" class="btn btn-warning">Voltar</a>
        </div>
    </div>
</div>
@endsection

<style>
    .btn-primary, .btn-danger, .btn-warning{
        margin-top:5px;
        margin-bottom:2px;
        padding:8px;
        width:100%;
    }
</style>