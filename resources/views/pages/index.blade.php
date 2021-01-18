@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{ $title }}</h1>
        <a class="btn btn-primary" href="/posts" role="button">Go To Blog</a>
    </div>
@endsection
