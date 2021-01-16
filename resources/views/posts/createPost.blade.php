@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' =>'POST']) !!}
    {{-- Since HTML forms only support POST and GET, PUT and DELETE methods will be spoofed by automatically adding a _method hidden field to your form. --}}
    {{-- @method('PUT') --}}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'id' => 'body', 'placeholder' => 'Body']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}


@endsection
