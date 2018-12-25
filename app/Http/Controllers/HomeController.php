<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clipboard;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search()
    {
    	return view('search.index');
    }
}
