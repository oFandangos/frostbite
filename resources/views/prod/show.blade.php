@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Informações sobre o produto</h2>
                    <hr/>

                    @foreach($produto->files as $file)
                    <img style="width:100%;" src="/files/{{$file->id}}">
                    @endforeach
                    
                    <p>Nome: {{$produto->nome_prod}}</p>
                    <p>Categoria: {{$produto->category->nome_cat}}</p>
                    <p>Autor: <a href="">{{$user->email ?? 'N/A'}}</a></p>
                    @if(isset($autor) && ($autor->id == $produto->user_id))
                        @include('files.partials.form')
                        <a href="/produto/edit/{{$produto->id}}" class="btn btn-warning" style="width:100%; margin-top:8px;"><i class="bi bi-pencil-square"></i>Editar Produto</a>
                        <form method="post" action="/produto/{{$produto->id}}">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');" style="width:100%; margin-top:8px;"><i class="bi bi-trash-fill"> Excluir</i></button>
                    </form> 
                    @endif
                    <a class="btn btn-success"><i class="bi bi-cart-plus-fill"></i>R$ {{round($produto->valor_prod)}},00</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center" style="margin-top:20px;">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <label><b>Comente</b></label>
                    <form method="post" action="produto/comentar/{{$produto->id}}">
                        @csrf
                        <textarea class="form-control" name="comentario" value="{{ old('comentario') }}"></textarea>
                        <button class="btn btn-success">Enviar comentário</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8" style="margin-top:20px;">
            <div class="card">
                <div class="card-body">
                    @if($comentarios->count() > 0)
                    @foreach($comentarios as $comentario)
                    <div class="row">
                        <div class="col-12">    
                            <b>{{$comentario->user->name}}</b><i class="text-muted"> {{date('d/m/Y',strtotime($comentario->created_at))}}</i><br/>
                                {{$comentario->comentario}}
                                @if($comentario->comentario_usuario_id == auth()->user()->id)
                                <form method="post" action="/produto/comentar/delete/{{$comentario->id}}">
                                    @method('delete')
                                    @csrf
                                    <button
                                    type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?');"
                                    style="margin-top:8px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                            @endif
                            <hr/>
                        </div>
                    </div
                    @endforeach
                    @else
                    <div class="col">
                        <p class="text-center">Nenhum comentário encontrado.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection