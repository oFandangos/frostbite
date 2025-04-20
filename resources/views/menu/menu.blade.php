@extends('styles.app')
<!doctype html>
<html lang="pt-br">

<head>
  <title>Sistema Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
</body>

</html>

<header>
  <div class="div">
    <nav>
      <ul class="nav-links">
        <li><b><a href="/" class="a-links">SISTEMA LARAVEL</a></b></li>
        @can('is_user')
      <li class="a-links" id="dropdown-container">
        <a class="a-links" href="#" id="dropdown" name="dropdown">Produtos</a>
        <div class="submenu" id="submenu">
        <a class="a-links" href="/produto/create">Cadastrar</a>
        </div>
      </li>
    @endcan
        @can('is_admin')
      <li><a class="a-links" href="/user">Administração</a></li>
    @endcan
        @if(!auth()->check())
      <li><a class="a-links" href="/login">Logar</a></li>
      <li><a class="a-links" href="/cadastrar">Criar Conta</a></li>
    @else
      <li style="margin-left:65%;"><a class="a-links" href="/conta"><b>{{auth()->user()->name}}</b></a></li>
      <li>
        <form method="post" action="/logout" class="a-links">
        @csrf
        <button class="a-links" type="submit" id="logout">Deslogar</button>
        </form>
      </li>
  @endif
        <li><a id="drop"><b>DROPDOWN</b></a></li>
      </ul>
    </nav>
  </div>
</header>

<div class="container">
  <div class="row">
    <div class="col-12">
      @if(session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
    @endif

      @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
      <li style="color: rgb(121, 24, 24);">{{ $error }}</li>
    @endforeach
      </ul>
      </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif

      @if(session('info'))
      <div class="alert alert-info">
      {{ session('info') }}
      </div>
    @endif
    </div>
  </div>
</div>

<script>
  setTimeout(() => {
    let alert = document.querySelector('.alert');
    if (alert) {
      alert.style.transition = 'opacity 0.5s';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }
  }, 3000);
</script>


<style>
  .show-submenu {
    display: block;
  }
</style>

<script>
  const dropdown = document.getElementById('dropdown');
  const submenu = document.getElementById('submenu');

  dropdown.addEventListener('click', function (e) {
    e.preventDefault();
    submenu.classList.toggle('show-submenu');
  });

  // Fechar o submenu ao clicar fora
  document.addEventListener('click', function (e) {
    if (!dropdown.contains(e.target) && !submenu.contains(e.target)) {
      submenu.classList.remove('show-submenu');
    }
  });
</script>
@yield('content')