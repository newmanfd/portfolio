@extends('layouts.app')

@section('content')
    <h1>Contact</h1>
    <div class="card card-body border rounded shadow">
        <!-- Laravel collective syntax for forms -->
        {!! Form::open(['action' => 'ContactMsgController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <!-- Name -->
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => '']) }}
            </div>
            <!-- Email -->
            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => '']) }}
            </div>
            <!-- Title -->
            <div class="form-group">
                <!-- label title with actual text Title -->
                {{ Form::label('title', 'Title') }}
                <!-- empty string for empty textfield; then add attributes inside the array. form-control is BS class -->
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title of your message...']) }}
            </div>
            <!-- Message textarea -->
            <div class="form-group">
                {{ Form::label('message', 'Message') }}
                {{ Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Write your message...']) }}
            </div>
            <!-- Makes a post request to ContactMsgController@store. Send is the value. -->
            {{ Form::submit('Send', ['class' => 'btn btn-primary']) }} 
        {!! Form::close() !!}
    </div>
@endsection