@extends('menu.menu')
@extends('styles.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/produto/{{ $produto->id }}/edit" class="form-group">
                        @method("put")
                        @include('prod.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="/produto/show/{{$produto->id}}" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
</div>
@endsection