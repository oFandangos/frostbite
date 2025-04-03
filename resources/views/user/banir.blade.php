@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="text-center">Banir ou desbanir um usuário</h2>
                <hr />
                <form method="post" action="/adm/banido/{{$user->id}}">
                    @csrf
                    @method('put')
                    <div class="row" style="padding-left:15px; padding-right:15px;">
                        <input class="form-control" id="codpes" type="text" name="codpes" value="{{old ('codpes', $user->codpes)}}" placeholder="Insira o N. USP do Usuário">
                        <select name="is_banned" id="type-user" class="form-control">
                            <option value="1">Banir Usuário</option>
                            <option value="0">Desbanir Usuario</option>
                        </select>
                    </div>
                    <textarea id="txt" class="form-control" placeholder="Insira o motivo" name="justificativa" required></textarea>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja realizar esta ação?');">Executar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    #codpes{
        width:64%;
        margin-right:5px;
    }

    #type-user{
        width:35%;
    }

    .btn-danger{
        margin-top:20px;
        padding:15px;
        width:100%;
    }

    #txt{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>