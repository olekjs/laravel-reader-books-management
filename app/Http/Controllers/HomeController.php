<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function searchBook()
    {
        return view('search.book');
    }

    public function searchUser(Request $request)
    {
        $users = Profile::where('first_name', 'LIKE', '%' . $request->value . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->value . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('search.user', [
            'users' => $users,
        ]);
    }
}
