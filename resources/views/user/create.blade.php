@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="text-center">Cadastrar ou Remover um Administrador</h2>
                <hr />
                <form method="post" action="/adm/{{$user->id}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <input id="codpes" class="form-control" type="text" name="codpes" value="{{old ('codpes', $user->codpes)}}" placeholder="Insira o N. USP do Usuário">
                        <select name="is_admin" id="type-user" class="form-control">
                            <option value="1">Tornar Administrador</option>
                            <option value="0">Remover Administrador</option>
                        </select>
                    <button type="submit" class="btn btn-success" onclick="return confirm('Tem certeza que deseja atualizar este usuário?');">Cadastrar como administrador</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    #codpes{
        width:60%;
        margin-right:5px;
    }

    #type-user{
        width:39%;
    }

    .btn-success{
        margin-top:20px;
        padding:15px;
        width:100%;
    }
    .card-body{
        padding:40px !important;
    }
</style>