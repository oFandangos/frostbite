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
        <li><b>SISTEMA LARAVEL</b></li>
        <li><a class="a-links" href="/">Home</a></li>
          <li class="a-links" id="dropdown-container">
            <a class="a-links" href="#" id="dropdown" name="dropdown">Produtos</a>
            <div class="submenu" id="submenu">
              <a class="a-links" href="/produto/create">Cadastrar um produto</a>
            </div>
          </li>
        <li><a class="a-links" href="/conta">Conta</a></li>
        <li><a class="a-links" href="/user">Administração</a></li>
        <li><a id="drop"><b>DROPDOWN</b></a></li>
      </ul>
    </nav>
  </div>
</header>

<style>
  .show-submenu{
    display:block;
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