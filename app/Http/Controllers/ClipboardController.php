<?php

namespace App\Http\Controllers;

use App\Models\Clipboard;
use Auth;
use Illuminate\Http\Request;

class ClipboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Clipboard::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        return view('clipboard.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clipboard  $clipboard
     * @return \Illuminate\Http\Response
     */
    public function show(Clipboard $clipboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clipboard  $clipboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Clipboard $clipboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clipboard  $clipboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clipboard $clipboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clipboard  $clipboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clipboard $clipboard)
    {
        //
    }
}
