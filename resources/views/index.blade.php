@extends('menu.menu')
@section('content')

  <div class="container-fluid" style="padding:0; margin-top:-20px;">
    <div class="row">
    <div class="col-md-12" style="background-color:black; position:relative;">
      <div class="banner"></div>
      <div id="searchbar-container">
        <form method="get" action="/produtos/list">
          @csrf
          <input name="search" value="{{ old('search') }}" type="text" id="teste" placeholder="Pesquisar...">
          <button class="search"><i class="fas fa-search" style="color:white; font-size:25px;"></i></button>
        </form>
      </div>
    </div>
    </div>
  </div>

  <div class="container-fluid">
    <div id="a" style="padding:12px; border-radius:6px;"></div>
    <div class="row justify-content-center" id="paragrafo" style="margin-bottom:20px;">
    @foreach($produtos as $produto)
    <div class="col-lg-3" id="col">
      <div class="card">
      <div class="card-body">
      <a href="/produto/show/{{ $produto->id }}">
        @foreach ($produto->files as $file)
          <img src="/files/{{ $file->id }}" class="card-img-top" alt="{{ $produto->nome_prod }}">
        @endforeach
      </a>
      <div class="card-title">Título: {{ $produto->nome_prod  }}</div>
      <div class="card-title">Valor: R$ {{ $produto->valor_prod }},00</div>
      <a href="/produto/show/{{ $produto->id }}" class="comprar">Comprar</a>
      </div>
      </div>
    </div>
  @endforeach
    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const header    = document.querySelector('header');
    const banner    = document.querySelector('.banner');
    const container = document.getElementById('searchbar-container');

    // altura real do header (inclui padding, border etc)
    const headerH = header.offsetHeight;

    // ponto onde a barra deve “grudar”: fim do banner
    //const stickyPoint = banner.offsetTop + banner.offsetHeight - headerH;
    const stickyPoint = 510;

    window.addEventListener('scroll', () => {
      if (window.scrollY >= stickyPoint) {
        // passa a ser fixa, colada no menu
        container.style.position = 'fixed';
        // container.style.top      = headerH + 'px';   // exatamente abaixo do menu
        container.style.top = '20px';
        //container.style.left     = '53%';
        container.style.transform = 'translateX(-50%)';
        container.style.zIndex   = '1000';             // abaixo do header, se quiser atrás
      } else {
        // volta pro estado “flutuante” dentro do banner
        container.style.position = 'absolute';
        container.style.top      = '48%';
        //container.style.left     = '53%';
        container.style.transform = 'translate(-50%, -50%)';
        container.style.zIndex   = '1000';
      }
    });
  });
</script>


  <style>
    #btn {
    width: 100%;
    padding: 10px;
    color: white;
    outline: none;
    border-radius: 4px;
    transition: .2s;
    }

    #btn:hover {
    padding: 12px !important;
    }
  </style>

@endsection