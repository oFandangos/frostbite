@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/produto/{{$produto->id}}/edit">
                        @method("put")
                        @csrf
                        <h1 class="text-center">Editar Produto</h1>
                        <hr>
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_prod" class="form-control" value="{{old('nome_prod', $produto->nome_prod)}}" placeholder="Nome produto"><br />
                        <label for="valor">Valor</label>
                        <input type="text" name="valor_prod" class="form-control" value="{{old('valor_prod', $produto->valor_prod)}}" placeholder="Insira o valor"><br />
                        <label for="id">Categoria</label>
                        <!-- <input type="text" name="category_id" placeholder="insira o id"><br /> -->
                        <select name="category_id" class="form-control">
                        
                        @foreach($categories::categories() as $category)

                        <option value="{{$category->id}}">
                            {{$category->nome_cat}}
                        </option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-success" style="width:100%; padding:10px; margin-top:10px;"><i class="bi bi-pencil-square"></i> Editar produto</button>
                    </form>
                </div>
            </div>
        <a href="/" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Voltar</a>
        </div>
    </div>
</div>
@endsection
<style>
    .btn-warning{
        
        margin-top:10px;
    }
    .bi-search{
        margin:0;
        padding-right:5px;
    }
</style>