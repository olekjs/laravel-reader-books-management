<?php

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'clipboard', 'as' => 'clipboard.'], function () {
        Route::get('', 'ClipboardController@index')->name('index');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('', 'ProfileController@index')->name('index');
    });

    Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
        Route::get('', 'HomeController@search')->name('index');
    });

    Route::group(['prefix' => 'read', 'as' => 'read.'], function () {
        Route::get('book/{title}', 'BookController@read')->name('index');
    });

    Route::namespace('Api')->group(function () {
        Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
            Route::post('addToCurrentlyRead', 'MainController@addToCurrentlyRead');
            Route::post('addToClipboard', 'MainController@addToClipboard');
        });
    });
});