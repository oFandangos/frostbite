@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($produtos as $produto)
            <div class="card">
                <div class="card-body">
                ID: {{$produto->id}}<br />
                Nome produto: {{$produto->nome_prod}}<br />
                Valor Produto: {{$produto->valor_prod}} <br />
                Autor: {{$produto->email}}
                    <div class="row" id="row">
                        <form method="post" action="/adm/aprovar/{{$produto->id}}">
                            @csrf
                            @method('put')
                            <button value="aprovado" name="status" class="btn btn-success">Aprovar</button>
                        </form>
                        <form method="post" action="/adm/reprovar/{{$produto->id}}">
                            @csrf
                            @method('put')
                        <button type="submit" value="reprovado" name="status" class="btn btn-danger">Reprovar</button>
                        </form>
                        <form method="post" action="/adm/retornar/{{$produto->id}}">
                            @csrf
                            @method('put')
                            <button value="voltar_user" name="status" class="btn btn-warning">Retornar para o usuário</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            @empty
            <div class="alert alert-info">Não há produtos para análise!</div>
            <a href="/user/" class="btn btn-info">Voltar</a>
            @endforelse
        </div>
    </div>
</div>

@endsection


<style>
    .card{
        margin-top:15px;
    }

    #row{
        padding:10px;
    }

    form{
        margin:5px;
    }
</style>