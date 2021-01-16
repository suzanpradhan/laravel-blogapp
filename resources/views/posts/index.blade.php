@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <a href="/posts/{{ $post->id }}">
                <div class="card p-3 mt-3 mb-3">
                    <h1>
                        {{ $post->title }}
                    </h1>
                    <small>
                        Written on {{ $post->created_at }}
                    </small>

                </div>
            </a>
        @endforeach
        {{ $posts->links() }}
    @else
        <h1>No Posts Found.</h1>

    @endif
@endsection
