@extends('menu.menu')
@section('content')
@if(request()->url() == url('/'))
<form action="/" method="get">
    <div class="row">
      <div class="col-2" style="margin-right:10px;">
        <input type="text" name="search" value="{{request()->search}}" class="form-control"  placeholder="Insira o nome do produto">
      </div>
      <div class="col-2">
        <select name="nomecategoria" class="form-control" style="margin-left:-30px;">
          <option value="" name="">- Selecione a Categoria -</option>
          @foreach($categories::categories() as $category)
          <option value="{{$category->nome_cat}}" name="nomecategoria"
            @if($category->nome_cat == Request()->nomecategoria) selected @endif
            >{{$category['nome_cat']}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-4">
        <button class="btn btn-success" type="submit" style="margin-left:-20px;">Pesquisar</button>
      </div>
    </div>
  </form>
@endif

<div class="container-fluid">
  <div class="row justify-content-center">
    @forelse($produtos as $produto)
    <div class="col-3">
      <div class="card" style="margin-bottom:32px;">
        <div class="card-body">
          <h5 class="card-title">{{$produto->nome_prod}}</h5>
          <p class="card-text">Preço: R$ <span class="num">{{$produto->valor_prod}}</span></p>
          <p class="card-text">Categoria: {{$produto->category->nome_cat}}</p>
          <p class="card-text">Descrição: {{$produto->descricao}}</p>
          <p class="card-text">Autor: <a href="">{{$produto->user->email}}</a></p>
          <a href="produto/show/{{$produto->id}}" class="btn btn-primary">Comprar</a>
        </div>
      </div>
    </div>

    @empty

    <p class="text-danger">Es tut mir leid! Es gibt keine Produkte für Sie.</p>
    <a href="/conta/">Zurück zum personalprofil</a>

    @endforelse
  </div>
</div>

{{-- 

  <div class="card">
    <div class="card-body">
      Temperatura atual: {{round($temperatura['main']['temp'], 0)}} ºC <img src="http://openweathermap.org/img/w/{{$icon}}.png" alt="Clima" />
    </div>
  </div>
  --}}
  
      <script>
        // Função para formatar número com pontos como separadores de milhar
        function formatNumber(num) {
        // Separar parte inteira e decimal
        let parts = parseInt(num).toFixed(2).split('.');
        // Adicionar pontos como separadores de milhar
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        // Juntar parte inteira e decimal com vírgula
        return parts.join();
    }
    // Selecionar todas as células de preço e formatar os números
    document.querySelectorAll('.num').forEach(function(element) {
        let formattedNumber = formatNumber(element.textContent);
        element.textContent = formattedNumber;
    });
</script>
@endsection