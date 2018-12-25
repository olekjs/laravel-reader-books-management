<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
    	'title',
    	'author',
    	'category',
    	'epochs',
    	'photo',
    	'link_to_txt',
    	'isbn',
    	'number_pages',
    ];
}
