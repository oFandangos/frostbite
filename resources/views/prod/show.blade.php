@extends('menu.menu')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Informações sobre o produto</h2>
                    <hr />

                    @foreach($produto->files as $file)
                        <img style="width:100%;" src="/files/{{$file->id}}">
                    @endforeach

                    <p>Nome: {{$produto->nome_prod}}</p>
                    <p>Categoria: {{$produto->category->nome_cat}}</p>
                    <p>Autor: <a href="">{{$user->email ?? 'N/A'}}</a></p>
                    @if(isset($autor) && ($autor->id == $produto->user_id))
                        @include('files.partials.form')
                        <div class="row" style="margin:4px;">
                            <a href="/produto/edit/{{$produto->id}}" class="btn btn-primary" style="margin-top:8px; height:100%; margin-right:8px;">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="post" action="/produto/{{$produto->id}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');"
                                    style="margin-top:8px;"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                    <a class="btn btn-success"><i class="fas fa-cart-plus"></i>R$ {{round($produto->valor_prod)}},00</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('prod.partials.comentarios')

@endsection