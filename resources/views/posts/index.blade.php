@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
                <div class="card p-3 mt-3 mb-3">
                <div class="row">
                    <div>
                        <img style=" width: 20rem; height: 10rem; object-fit: cover; margin-left: 1rem; margin-right: 1rem;" src="/storage/cover_images/{{$post->cover_image}}" alt="cover_image">
                    </div>
                    <div style="display: flex; flex-direction: column; justify-content: center">
                        
                        <div>
                            <a href="/posts/{{$post->id}}">
                            <h1>
                                {{ $post->title }}
                            </h1>
                        </a>
                        </div>
                        <div>
                            <small>
                                Written on {{ $post->created_at }} by {{$post->user->name}}
                            </small>
                            </div>
                    </div>
                </div>
                    

                </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <small>No Posts Found.</small>

    @endif
@endsection
