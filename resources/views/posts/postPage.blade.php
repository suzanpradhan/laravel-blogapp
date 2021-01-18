@extends('layouts.app')
@section('content')
    <div class="post__row">
        <div>
            <a href="/posts">
                <button type="button" class="btn btn-primary mt-3 mb-3">
                    Go Back
                </button>
            </a>

        </div>
        @auth
        @if (Auth::user()->id == $eachPost->user_id)
        <div class="post__action">
            <a href="/posts/{{ $eachPost->id }}/edit">
                <button type="button" class="btn btn-primary mt-3 mb-3" style="margin-right: 1rem">
                    Edit
                </button>
            </a>
            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $eachPost->id], 'method' => 'DELETE'])
            !!}

            {{ Form::submit('Delete', ['class' => 'btn btn-danger mt-3 mb-3']) }}
            {!! Form::close() !!}
        </div>
        @endif
        
        @endauth
        


    </div>
    <img src="/storage/cover_images/{{$eachPost->cover_image}}" alt="cover_image" style="width: 100%; height: 30rem; margin-bottom: 2rem; object-fit: cover">
    <h1>
        {{ $eachPost->title }}
    </h1>

    <small>
        {!! $eachPost->body !!}
    </small>
    <hr>
    <small>
        {{ $eachPost->created_at }} by {{$eachPost->user->name}}
    </small>

@endsection
