@extends('laravel-usp-theme::master')
@extends('styles.app')
@section('content')
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-3">
            <h4>Cadastrar categoria</h4>
              <div class="card-body">
              <form method="post" action="/cat">
            @csrf
            <label for="nome">Nome cat</label>
            <input type="text" name="nome_cat" class="form-control" placeholder="Nome da categoria"><br />
            <button type="submit" class="btn btn-success">Cadastrar Categoria</button>
            </form>
              </div>
          </div>
        </div>
      </div>
<br />
@endsection

<style>
  .card-body{
    box-shadow: 5px 5px 10px 5px rgb(30, 30, 30, 0.2);
    border-radius:5px;
  }
</style>