<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use Auth;

class FriendController extends Controller
{
    public function index()
    {
    	return view('friend.index', [
    		'friends' => $this->getFriendsToView(),
    	]);
    }
    //wtf?
    private function getFriendsToView()
    {
    	$friends = null;
    	$types = ['user_id', 'friend_id'];

    	foreach($types as $type) {
    		$query = Friend::where($type, Auth::id())->where('status', 2)->get();

    		if($query != null) {
    			if($type == 'user_id'){
    				return $friends = ['user', $query];
    			} else if($type == 'friend_id') {
    				return $friends = ['friend' , $query];
    			}
    		}
    	}
    }
}
