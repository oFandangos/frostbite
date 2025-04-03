@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
        <div class="card-body">
            <form method="post" action="/produto">
            <h4 class="text-center">Cadastrar produto</h4>
            <hr>
            @csrf
            <input type="hidden" name="user_id" class="form-control" placeholder="ID do user" value="{{$userId}}">
            </select>
            <input type="hidden" name="status" value="em_analise">
            <label for="nome">Nome</label>
            <input type="text" name="nome_prod" class="form-control" placeholder="Nome produto"><br />
            <label for="valor">Valor</label>
            <input type="text" name="valor_prod" class="form-control" placeholder="Insira o valor"><br />
            <label for="id">Categoria</label>
            <!-- <input type="text" name="category_id" placeholder="insira o id"><br /> -->
            <select name="category_id" class="form-control">
                @foreach($categories::categories() as $category)
                  <option value="{{$category->id}}">
                    {{$category->nome_cat}}
                  </option>
            @endforeach
            </select>
            <button type="submit" class="btn btn-success" style="width:100%; padding:10px; margin-top:10px;">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<a href="/"><button class="btn btn-outline-primary">Voltar</button></a>
<br />
@endsection

<style>
  .card-body{
    box-shadow: 5px 5px 10px 5px rgb(120, 120, 120, 0.2);
    border-radius:5px;
  }
</style>