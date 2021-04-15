@extends('layouts/app')

@section('content')
    <a href="/posts" class="btn btn-info text-white">Go back</a>
    <br><br>
    <!-- Post box -->
    <div class="card card-body border rounded shadow-sm">
        <h1>{{ $post->title }}</h1>
        <? /* <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}"> */ ?>
        <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small> <!-- looks into Post model's user() -->
        <hr><br>
        {{ $post->body }}
        <br><br>
        
        <!-- Buttons -->
        <div>
            @if(!Auth::guest()) <!-- if the user is not a guest -->
                @if(Auth::user()->id == $post->user_id) <!-- if the user is the creator of the post, then show the btns -->
                    <!-- Edit btn -->
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-light">Edit</a> <!-- Look into PostsController@edit -->
                    <!-- Delete btn -->
                    <!-- method is POST but pretending to be a DELETE -->
                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                @endif    
            @endif
        </div>
    </div>
    <br>

    <!-- If the user is not a guest then show a textarea to post a comment -->
    @if(!Auth::guest())
        <div class="card card-body border rounded shadow-sm">
            <h4>Post a comment</h4>
            {!! Form::open([ 'action' => 'CommentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{ Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'style' => 'height:80px']) }}
                </div>
                {{ Form::submit('Publish', ['class' => 'btn btn-success btn-sm']) }} 
            {!! Form::close() !!}
        </div>
        <br>
    @else <!-- login or register to comment -->
        <div class="card card-body border rounded shadow-sm text-center">
            <h4>Login or Register to be able to comment</h4>
            <p><a class="btn btn-success btn" href="/login" role="button">Login</a> <a class="btn btn-primary btn" href="/register" role="button">Register</a></p>
        </div>
        <br>
    @endif

    <!-- Comment section box -->
    <div class="card card-body border rounded shadow-sm">
        @if(count($comments) > 0)        
            <h4>Comments ({{ count($comments)}})</h4>
            <hr>
            @foreach ($comments as $comment)
                <p>{{ $comment->comment }}</p>
                <small> By {{ $comment->author }} on {{ $comment->created_at }}</small>
                <hr>               
            @endforeach
        @else
            <h4>Comments (0)</h4><br>
        @endif 
    </div>
@endsection

