@extends('menu.menu')
@extends('styles.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            @foreach($produtos as $produto)
                <div class="col-md-8">
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
                                    <button value="aprovado" name="status" class="comprar">Aprovar</button>
                                </form>
                                <form method="post" action="/adm/reprovar/{{$produto->id}}">
                                    @csrf
                                    @method('put')
                                    <button type="submit" value="reprovado" name="status"
                                        class="btn btn-danger">Reprovar</button>
                                </form>
                                <form method="post" action="/adm/retornar/{{$produto->id}}">
                                    @csrf
                                    @method('put')
                                    <button value="voltar_user" name="status" class="btn btn-warning">Retornar para o
                                        usuário</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>

@endsection


<style>
    .card {
        margin-top: 15px;
    }

    #row {
        padding: 10px;
    }

    form {
        margin: 5px;
    }
</style>