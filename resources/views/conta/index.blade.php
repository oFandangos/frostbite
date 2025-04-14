@extends('menu.menu')
@extends('styles.app')
@section('content')

minha conta

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p>{{$auth->email}}</p>
                    <p>{{$auth->name}}</p>
                    <p>{{$auth->codpes}}</p>
                    <a href="/conta/edit/{{$auth->id}}">Editar conta</a><br/>
                    <a href="/conta/produtos/{{$auth->id}}">Meus produtos</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

