@extends('layouts/app')

@section('content')
    <h1>Edit Post</h1>
    <div class="card card-body border rounded shadow">
        <!-- Laravel collective package syntax for forms -->
        {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <!-- post title -->
            <div class="form-group">
                <!-- label title with actual text Title -->
                {{ Form::label('title', 'Title') }}
                <!-- empty string for empty textfield; then add attributes inside the array. form-control is BS class -->
                {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title of your post...']) }}
            </div>
            <!-- post body -->
            <div class="form-group">
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Write your post...']) }}
            </div>
            <!-- Spoofing a PUT request since there isn't a POST request for PostsController@update as you see in php artisan route:list -->
            <!-- You can only use a POST or GET as a method. You spoof by adding a hidden input -->
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('Done', ['class' => 'btn btn-primary']) }} 
        {!! Form::close() !!}
    </div>
@endsection