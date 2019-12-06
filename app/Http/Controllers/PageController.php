<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function android(){
    	return view('menu/top_nav/android');
    }
    public function contact(){
    	return view('menu/top_nav/contact');
    }
}
