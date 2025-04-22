@extends('menu.menu')
@extends('styles.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <h3 class="text-center">Área admnistrativa</h3>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-8">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    
                </div>
                <div class="col-md-8">
                    <form method="get" action="/user">
                        <input type="text" id="search" name="search" value="{{request()->search}}" class="form-control" placeholder="Insira o nome ou código de usuário">
                        <button type="submit" class="comprar"><i class="fa fa-search"></i> Procurar</button>
                    </form>
                </div>
            </div>
            <hr />

            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Usuários</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                <td>
                    {{$user->name}} - {{$user->codpes}} 
                    @if($user->is_admin == 1) - <b class="text-success">ADM</b>
                    @elseif($user->is_banned == 1) - <b class="text-danger">BANIDO</b>
                    @endif
                </td>
                <td>
                    <a href="/adm/create/{{$user->id}}" class="btn btn-primary"><i class="fas fa-user-plus"></i></a>
                    <a href="/adm/banir/{{$user->id}}" class="btn btn-danger"><i class="fa fa-hammer"></i></a>
                </td>
                <td>
            @empty
            <p class="text-center text-danger">Não foram encontrados usuários</p>
            </tr>
            </tbody>            
        @endforelse
        </table>
        </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <h3 class="text-center">Ações do Administrador</h3>
                <hr />
                    <a href="/newsletter/create" class="btn btn-info"><i class="fas fa-plus-circle"></i> Adicionar Newsletter</a>
                    <a href="/adm/prod-listar" class="btn btn-warning"><i class="fa fa-flag"></i> Produtos a serem aceitos</a>
                    <a href="/cat" class="btn btn-primary" id="success"><i class="fas fa-eye"></i>Ver categorias</a>
                </div>
            </div>
        </div>  
    </div>
</div>

<style>
    .col-md-8, .col-md-4{
        margin-top:15px;
    }
    .form-control{
        margin-top:5px;
        display:initial !important;
        width:70%;
    }
    .btn-info, .btn-warning, #success{
        width:100%;
        margin-top:8px;
    }

    .btn-primary{
        
    }

    /* form{
        padding:0 !important;
        margin:0;
    } */
</style>

@endsection