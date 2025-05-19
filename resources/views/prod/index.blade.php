@extends('menu.menu')
@section('content')
    <div class="container-fluid">
        <form method="get" action="/produtos/list">
            @csrf
            <input name="search" value="{{ old('search') }}" type="text" id="input_search" placeholder="Pesquisar...">
            <button class="search"><i class="fas fa-search" style="color:rgb(0, 0, 0); font-size:25px;"></i></button>
        </form>
        <div id="a" style="padding:12px; border-radius:6px;"></div>
        <div class="row" id="paragrafo" style="margin-bottom:20px;">
            @forelse ($produtos as $produto)
                <div class="col-lg-3" id="col">
                    <div class="card">
                        <div class="card-body">
                            <a href="/produto/show/{{ $produto->id }}">
                                <img 
                                @foreach ($produto->files as $file)
                                    src="/files/{{ $file->id }}" class="card-img-top" alt="..."
                                @endforeach
                                >
                            </a>
                            <div class="card-title">Título: {{ $produto->nome_prod }}</div>
                            <div class="card-title">Valor: R$ {{ $produto->valor_prod }},00</div>
                            <a href="/produto/show/{{ $produto->id }}" class="comprar">Comprar</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Nenhum produto encontrado.
                </div>
            @endforelse
        </div>
    </div>
@endsection
