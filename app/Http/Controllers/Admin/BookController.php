<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
    	return view('admin.book.index', [
    		'books' => Book::paginate(20),
    	]);
    }
}
