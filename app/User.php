<?php

namespace App;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->where('status', 1);
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends_users', 'user_id', 'friend_id')
            ->wherePivot('status', '=', 2)
            ->withPivot('status');
    }

    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends_users', 'friend_id', 'user_id')
            ->wherePivot('status', '=', 2)
            ->withPivot('status');
    }

    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends_users', $this->relations)) {
            $this->loadFriends();
        }

        return $this->getRelation('friends_users');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends_users', $this->relations)) {
            $friends = $this->mergeFriends();

            $this->setRelation('friends_users', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }
}
