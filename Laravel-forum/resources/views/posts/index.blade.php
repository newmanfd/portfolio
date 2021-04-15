@extends('layouts/app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body border rounded shadow-sm">
                <? /* <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}"> */ ?>
                
                <!-- when clicked calls the PostsController@show -->
                <h3> <a href="/posts/{{ $post->id }}">{{ $post->title }}</a> </h3> 
                <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small> <!-- looks into Post model's user() -->
            </div>
            <br>
        @endforeach
    @else 
        <p>No posts found.</p>
    @endif
@endsection