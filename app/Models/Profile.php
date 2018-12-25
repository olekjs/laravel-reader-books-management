<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Clipboard;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'country',
        'city',
        'favorite_books',
        'about_me',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    public function getFullAddressAttribute()
    {
        return sprintf('%s, %s', $this->city, $this->country);
    }

    public function getStatistics()
    {
        $data = [
            'readBooks'   => $this->getReadBooksCount(),
            'accountDays' => $this->getAccountDaysCount(),
        ];

        return $data;
    }

    private function getReadBooksCount()
    {
        return Clipboard::where([['user_id', $this->user_id],['status', 2]])->get()->count();
    }

    private function getAccountDaysCount()
    {
        $createdDate = Carbon::createFromFormat('Y-m-d H:i:s', $this->user->created_at);
        $today       = Carbon::now();

        return $createdDate->diffInDays($today);
    }
}
