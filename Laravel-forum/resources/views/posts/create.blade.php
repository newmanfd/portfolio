@extends('layouts/app')

@section('content')
    <h1>Create a Post</h1>
    <div class="card card-body border rounded shadow">
        <!-- Laravel collective package syntax for forms -->
        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <!-- post title -->
            <div class="form-group">
                <!-- label title with actual text Title -->
                {{ Form::label('title', 'Title') }}
                <!-- empty string for empty textfield; then add attributes inside the array. form-control is BS class -->
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title of your post...']) }}
            </div>
            <!-- post body -->
            <div class="form-group">
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Write your post...']) }}
            </div>
            <? /* File upload btn 
            <div class="form-group">
                {{ Form::file('cover_image') }}
            </div>
            */ ?>
            <!-- Makes a post request to PostsController@store. Publish is the value. -->
            {{ Form::submit('Publish', ['class' => 'btn btn-primary']) }} 
        {!! Form::close() !!}
    </div>
@endsection