<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clipboard\UpdateBookmarkRequest;
use App\Http\Requests\Clipboard\UpdateNotesRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Book;
use App\Models\Clipboard;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Olekjs\Wolnelektury\Facade as Wolnelektury;

class MainController extends Controller
{
    public function getBook(Request $request)
    {
        $book = Book::where('title', $request->title)->first();

        return $book ?: Wolnelektury::getBook($request->title);
    }

    public function addToCurrentlyRead(Request $request)
    {
        return $this->findOrCreateBook($request, 3);
    }

    public function addToClipboard(Request $request)
    {
        return $this->findOrCreateBook($request, 2);
    }

    public function saveNotes(UpdateNotesRequest $request)
    {
        Clipboard::where('id', $request->item_id)->update(['notes' => $request->notes]);
    }

    public function saveBookmark(UpdateBookmarkRequest $request)
    {
        Clipboard::where('id', $request->item_id)->update(['bookmark' => $request->bookmark]);
    }

    public function saveProfile(UpdateRequest $request)
    {
        $data = [
            'user_id'        => $request->user_id,
            'first_name'     => $request->firstName,
            'last_name'      => $request->lastName,
            'country'        => $request->country,
            'city'           => $request->city,
            'favorite_books' => $request->favoriteBooks,
            'about_me'       => $request->aboutMe,
            'photo'          => $request->linkToPhoto,
        ];

        Profile::where('user_id', $data['user_id'])->update($data);
    }

    public function saveAsRead(Request $request)
    {
        Clipboard::where('id', $request->item_id)->update(['status' => 2]);
    }

    public function saveAsUnRead(Request $request)
    {
        Clipboard::where('id', $request->item_id)->update(['status' => 3]);
    }

    public function deleteFromBookmark(Request $request)
    {
        Clipboard::where('id', $request->item_id)->delete();
    }

    private function findOrCreateBook($request, $status)
    {
        $data = [
            'title'       => $request->book['title'],
            'author'      => $request->book['author'],
            'category'    => $request->book['category'],
            'epochs'      => $request->book['epochs'],
            'photo'       => $request->book['photo'],
            'link_to_txt' => $request->book['link_to_txt'],
        ];

        $book = Book::firstOrCreate($data);

        return $this->saveBookInClipboard($book, $status);
    }

    private function saveBookInClipboard($book, $status)
    {
        $data = [
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'status'  => $status,
        ];

        $item = Clipboard::where([['book_id', $book->id], ['user_id', Auth::id()]])->first();

        if ($item == null) {
            Clipboard::create($data);
        } else {
            $item->status = $status;
            $item->save();
        }

    }
}
