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

Route::get('post', 'PostsController@index');

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/about', function () {
//    return "This is an about page.";
//});
//
//Route::get('/contact', function () {
//    return "This is a contact page.";
//});
//
//Route::get('/post/{id}/{name}', function ($id, $name) {
//    return "This is the post number " . $id . " " . $name;
//});
//
//Route::get('admin/posts/example', array('as' => 'admin.routes', function() {
//
//    $url = route('admin.routes');
//    return "This is the url: " . $url;
//
//}));