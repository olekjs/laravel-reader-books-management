<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Friend extends Model
{
    protected $fillable = [
        'user_id',
        'friend_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function friend()
    {
    	return $this->belongsTo(User::class);
    }
}