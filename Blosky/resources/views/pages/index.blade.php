@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome to the Blosky application</h1>
        <p>Blosky it's a web application for sharing your daily blogs and news</p>
        <p>
            <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
        </p>
    </div>
@endsection

