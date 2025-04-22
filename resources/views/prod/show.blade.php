@extends('menu.menu')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <img src="/front.png" style="width:100%;">
                </div>
            </div>
        </div>
        <div class="col-4">
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
                    @endif
                    <a class="btn btn-success" style="color:white;"><i class="fas fa-cart-plus"></i>R$ {{round($produto->valor_prod)}},00</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('prod.partials.comentarios')

@endsection