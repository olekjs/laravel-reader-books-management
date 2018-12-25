<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
	Route::post('/getBook', 'MainController@getBook');
	Route::post('/saveNotes', 'MainController@saveNotes');
	Route::post('/saveBookmark', 'MainController@saveBookmark');
	Route::post('/saveProfile', 'MainController@saveProfile');
	Route::post('/saveAsRead', 'MainController@saveAsRead');
	Route::post('/saveAsUnRead', 'MainController@saveAsUnRead');
	Route::post('/deleteFromBookmark', 'MainController@deleteFromBookmark');
});
