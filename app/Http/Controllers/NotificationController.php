<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class NotificationController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Pacific/Auckland');
    	return json_encode(Entry::with('user')->where('time', '>', date("Y-m-d H:i:s", time()-30) )->get());
    }
}
