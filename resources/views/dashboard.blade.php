@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-primary" href="/posts/create" role="button">Create Post</a>
                        <div class="container mt-3 mb-3">
                            <h1>Your Posts</h1>
                            @if (count($posts) > 0)
                                <table class="table table-stripped">
                                    <tbody>
                                        <tr>
                                            <th>Cover Image</th>
                                            <th>Title</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    <img src="/storage/cover_images/{{$post->cover_image}}" alt="cover_image" style="width: 10rem; height: 6rem; object-fit: cover">
                                                </td>
                                                <td>{{ $post->title }}</td>

                                                <td>
                                                    <a class="btn btn-primary" href="/posts/{{ $post->id }}/edit"
                                                        role="button">Edit</a>
                                                </td>
                                                <td>
                                                    {!! Form::open(['action' =>
                                                    ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' =>
                                                    'DELETE']) !!}

                                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
