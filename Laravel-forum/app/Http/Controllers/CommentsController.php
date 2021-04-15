<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session; 

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        // Create a comment
        $comment = new Comment;
        $comment->comment = $request->input('comment'); 
        $comment->post_id = Session::get('postId')->id;
                                                        
        $comment->author = auth()->user()->name;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        //dd($request->route()->parameters());
        //dd($request->route('id'));

        // sets a success message that goes to the messages.blade
        return redirect('/posts')->with('success', 'Your comment is published successfully.');
    }
}
