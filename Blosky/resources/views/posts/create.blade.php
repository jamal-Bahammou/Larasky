@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            {{ Form::label('title', 'Blog Title :') }}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter blog title ...']) }}
        </div>
        
        <div class="form-group">
            {{ Form::label('body', 'Blog Body :') }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Enter blog body ...']) }}
        </div>

        <div class="form-group">
            {{ Form::file('cover_image') }}
        </div>
        
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
   
    {!! Form::close() !!}
@endsection