<?php

namespace App\Models;

use App\Models\Book;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Clipboard extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'notes',
        'bookmark',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function IsRead()
    {
        $status = $this->status;

        if($status == 1){
            return 'Nieprzeczyatna';
        } elseif($status == 2){
            return 'Przeczytana';
        } elseif ($status == 3) {
            return 'W trakcie czytania';
        }
    }
}
