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
                            <button value="reprovar" name="status" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Reprovar</button>
                        <form method="post" action="/adm/retornar/{{$produto->id}}">
                            @csrf
                            @method('put')
                            <button value="voltar_user" name="status" class="btn btn-warning">Retornar para o usuário</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reprovar produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/adm/reprovar/{{$produto->id}}">
                <div class="modal-body">
                    <textarea name="justificativa_reprovado" value="{{old('justificativa_reprovado', $produto->justificativa_reprovado)}}" class="form-control" placeholder="Insira a justificativa"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        @csrf
                        @method('put')
                    <button type="submit" value="reprovado" name="status" class="btn btn-danger">Reprovar</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            @empty
            <div class="alert alert-info">Não há produtos para análise!</div>
            <a href="/user/" class="btn btn-info">Voltar</a>
            @endforelse

            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Reprovados</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @foreach($produtosReprov as $prod)
                        <b>Nome do Produto: </b>{{$prod->nome_prod}}</p>
                        <b>Valor: </b> R${{$prod->valor_prod}}</p>
                        <b>Autor: </b><a href="">{{$prod->email}}</a></p>
                        <b>Motivo da Reprovação: </b><p>{{$prod->justificativa_reprovado ?? 'N/A'}}</p></b>
                        <b>Data reprovação: </b>{{date('d/m/Y', strtotime($prod->updated_at))}}
                        <hr/>
                    @endforeach
                </div>
            </div>
            
            
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

    .btn-danger{
        margin:5px !important;
    }

</style>