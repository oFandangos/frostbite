@extends('laravel-usp-theme::master')
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

