@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">BACK</a>
    <h1>{{ $post->title }}</h1>
    <img style="height:500px" src="/storage/cover_images/{{$post->cover_image}}" >
    <br><br>
    <div>{{ $post->body }}</div>
    <hr>
    <small>Written by {{ $post->user->name }} on {{ $post->created_at }}</small>
    <hr>
    @if (!Auth::guest())
        @if ( Auth::user()->id == $post->user_id )
            <a href="/posts/{{$post->id}}/edit" class="btn btn-success">EDIT</a>
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
        @endif
    @endif

    <br><br>

@endsection