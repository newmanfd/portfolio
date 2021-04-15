@extends('layouts/app')

@section('content')
    <div class="card card-body border rounded shadow text-center">
        <h1>{{ $title }}</h1> <!-- See PagesController@index -->
        <h5>This is a discussion forum built with Laravel.</h5><br>    
        <p><a class="btn btn-success btn" href="/login" role="button">Login</a> <a class="btn btn-primary btn" href="/register" role="button">Register</a></p>
        <br><h5>-OR-</h5><br>
        <p><a class="btn btn-info text-white btn" href="/posts" role="button">Continue as Guest</a></p>
    </div>
@endsection
    


 
