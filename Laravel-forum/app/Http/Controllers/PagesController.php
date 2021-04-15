<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Brings in the Request library to handle requests

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to Laravel Forum'; 
        return view('pages/index')->with('title', $title); 
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function benefits()
    {
        $data = array(
            'title' => 'Benefits of Registering',
            'benefitReasons' => ['Ability to post', 'Ability to comment on posts', 'Receive any news and updates']
        );
        return view('pages/benefits')->with($data); 
    }
}


