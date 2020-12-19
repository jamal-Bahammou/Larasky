@extends('layouts.app')

@section('content')
    <h1>Update Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{ Form::label('title', 'Blog Title :') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter blog title ...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Blog Body :') }}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Enter blog body ...']) }}
        </div>

        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>

        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

    {!! Form::close() !!}
@endsection