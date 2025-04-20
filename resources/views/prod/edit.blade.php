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
    <a href="/produto/show/{{$produto->id}}" class="btn btn-warning"><i class="fas fa-arrow-left"></i></a>
</div>
@endsection
<style>
    .form-floating-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-floating-group .input {
        width: 100%;
        padding: 12px 8px;
        font-size: 16px;
        border: 0;
        border-bottom: 1px solid #ccc;
        outline: none;
        background: none;
    }

    .form-floating-group label {
        position: absolute;
        top: 12px;
        left: 8px;
        color: #888;
        pointer-events: none;
        transition: 0.2s ease all;
        background: white;
        padding: 0 4px;
    }

    .form-floating-group .input:focus+label,
    .form-floating-group .input:not(:placeholder-shown)+label {
        top: -8px;
        left: 6px;
        font-size: 12px;
        color: #333;
    }

    select.input {
        appearance: none;
    }

    .form-floating-group select.input:valid+label {
        top: -8px;
        left: 6px;
        font-size: 12px;
        color: #333;
    }
</style>