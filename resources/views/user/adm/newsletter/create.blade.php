@extends('menu.menu')
@extends('styles.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/newsletter">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Titulo da Newsletter</label>
                            <input name="titulo" value="{{old('titulo')}}" type="text" placeholder="Insira o titulo da newsletter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea name="texto" value="{{old('texto')}}" class="form-control" placeholder="Insira a mensagem"></textarea>
                        </div>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <button type="submit" class="btn btn-success" style="width:100%; padding:8px;">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection