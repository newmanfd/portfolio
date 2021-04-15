<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Brings in the Request library to handle requests
use App\Post;
use App\Comment;
use Session;

class PostsController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Add exceptions to the authentication so that a guest can view these excepted pages:
         posts/index and posts/show*/
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('posts/index')->with('posts', $posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
            //'cover_image' => 'image|nullable|max:1999' // Providing an image is optional but the file has to be an image jpg jpeg gif etc
        ]);

        /*// ABILITY TO UPLOAD A FILE
        // Handles the file upload of Choose File btn
        if($request->hasFile('cover_image')) { // checks if the user clicked Choose File btn and selected an image
            // Gets filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store. The fact that it includes a timestamp makes the filename unique so it avoids
            // any overwriting by any other user having the same filename.
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image. Creates cover_images folder in storage/app/public
            // Needs a command to make the storage/app/public folder accessible to the browser so that the user's
            // request to upload an image will create the cover_images folder and the image will be saved there
            // php artisan storage:link
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }*/

        // Create a post
        $post = new Post;
        $post->title = $request->input('title'); 
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; 
        //$post->cover_image = $fileNameToStore;
        $post->save();

        // redirects and sets a success message that goes to the messages.blade
        return redirect('/posts')->with('success', 'Your post was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        $post = Post::find($id);
        $comments = Comment::all()->where('post_id', $id); 
        
        Session::put('postId', $post); 

        return view('posts/show')->with('post', $post)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id) { 
            return redirect('/posts')->with('error', 'Unauthorized Action! Access Denied.');
        }

        return view('posts/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::find($id); 
        $post->title = $request->input('title'); 
        $post->body = $request->input('body');
        $post->save();

        // redirects and sets a success message that goes to the messages.blade
        return redirect('/posts')->with('success', 'Your post was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id); 
        
        // Checks if this isn't the user that the post belongs to in order to deny deleting the post.
        if(auth()->user()->id !== $post->user_id) { 
            return redirect('/posts')->with('error', 'Unauthorized Action! Access Denied.');
        }

        // In order to delete any image as well
        /* if($post->cover_image != 'noimage.jpg') {
            // Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        } 
        also bring in this library: use Illuminate\Support\Facades\Storage;
        */
        
        $post->delete();
        // redirects and sets a success message that goes to the messages.blade
        return redirect('/posts')->with('success', 'Your post was deleted successfully.');
    }
}
