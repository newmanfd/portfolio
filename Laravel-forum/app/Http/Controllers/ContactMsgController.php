<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMsg;

class ContactMsgController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/contact');
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
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        // Create a contact message
        $msg = new ContactMsg;
        $msg->name = $request->input('name');
        $msg->email = $request->input('email');
        $msg->title = $request->input('title'); // gets whatever gets inputted into the input field
        $msg->message = $request->input('message');
        $msg->save();

        // redirects and sets a success message that goes to the messages.blade
        return redirect('/contact')->with('success', 'Your message was send successfully! We will get back to you soon.');
    }
}
