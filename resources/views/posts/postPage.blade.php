@extends('layouts.app')

@section('content')

    <a href="/posts">
    <button type="button" class="btn btn-primary mt-3 mb-3">
        Go Back
    </button>
    </a>
    <h1>
        {{$eachPost->title}}
    </h1>

    <small>
        {!!$eachPost->body!!}
    </small>
    <hr>
    <small>
        {{$eachPost->created_at}}
    </small>
    
@endsection