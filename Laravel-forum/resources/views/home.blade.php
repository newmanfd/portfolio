@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border rounded shadow">
                    <div class="card-header">Home Dashboard</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif                       
 
                        @if(count($posts) > 0)
                            <h5>Your Posts ({{ count($posts) }})</h5><hr>
                            @foreach($posts as $post)
                                <h6><a href="/posts/{{ $post->id }}" class="btn btn-link"> {{ $post->title }} </a>  
                                    {{ $post->comments->count() }} comments                  
                                </h6> 
                                <hr>                        
                            @endforeach
                        @else
                            <h5>You have no posts yet...</h5><br>
                        @endif   

                        <a href="/posts/create" class="btn btn-sm btn-primary float-right">Create a Post</a><br>       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
