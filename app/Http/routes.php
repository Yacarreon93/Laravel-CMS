<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\DB;

Route::resource('posts', "PostsController");

Route::get('/contact', "PostsController@contact");

Route::get('/post/{id}/{name}/{pass}', "PostsController@showPost");

Route::get('/insert', function() {

    DB::insert('INSERT INTO posts(title, content) VALUES(?, ?)', ['PHP with Laravel', 'PHP with Laravel is the best thing ever']);

});