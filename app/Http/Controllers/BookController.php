<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Olekjs\Wolnelektury\Facade as Wolnelektury;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    public function read($title)
    {
        $book = $this->firstOrCreateBook($title);

        $text = file_get_contents($book->link_to_txt, true);

        return view('read.index', [
            'book' => $book,
            'text' => $text,
        ]);
    }

    private function firstOrCreateBook($title)
    {
        $book = Wolnelektury::getBook($title);

        $data = [
            'title'       => $book['title'],
            'author'      => $book['author'],
            'category'    => $book['category'],
            'epochs'      => $book['epochs'],
            'photo'       => $book['photo'],
            'link_to_txt' => $book['link_to_txt'],
        ];

        return Book::firstOrCreate($data);
    }
}
