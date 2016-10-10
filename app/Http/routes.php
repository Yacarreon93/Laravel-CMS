<?php

use App\Post;
use App\User;
use App\Role;
use App\Country;

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

//Route::get('/read', function() {
//
//    $results = DB::select('SELECT * FROM posts WHERE id = ?', [1]);
//
////    foreach ($results as $post) {
////
////        return $post->title;
////
////    }
//
//    return var_dump($results);
//
//});

Route::get('/update', function() {

    $updated = DB::update('UPDATE posts SET title = ? WHERE id = ?', ["Updated title", 1]);

    return $updated;

});

Route::get('/delete', function() {

    $deleted = DB::delete('DELETE FROM posts WHERE id = ?', [1]);

    return $deleted;

});

/*
|--------------------------------------------------------------------------
| Eloquent
|--------------------------------------------------------------------------
*/

Route::get('/read', function() {

    $posts = Post::all();

//    foreach($posts as $post) {
//
//        return $post->title;
//
//    }
//
    return $posts;

});

Route::get('/find', function() {

    $post = Post::find(2);

    return $post;

});

Route::get('/findwhere', function() {

    $posts = Post::where('id', 3)->orderBy('id', 'DESC')->take(1)->get();

    return $posts;

});

//Route::get('/findmore', function() {
//
////    $posts = Post::findOrFail(1);
////
////    return $posts;
//
//});

Route::get('/basicinsert', function() {

    $post = new Post;

    $post->title = "New Eloquent title insert";
    $post->content = "Wow Eloquent is really cool";

    $post->save();

});

Route::get('/basicupdate', function() {

    $post = Post::find(3);

    $post->title = "New Eloquent title insert";
    $post->content = "Wow Eloquent is really cool";

    $post->save();

});

Route::get('/create', function () {

    Post::create(['title' => 'New title', 'content' => 'New content']);
    
});

Route::get('/update', function() {

    Post::where('id', 2)->where('is_admin', 0)->update(['title' => 'Updated', 'content' => 'Updated content']);

});

Route::get('/delete', function() {

    $post = Post::find(2);
    $post->delete();

});

Route::get('/delete2', function() {

    Post::destroy([4, 5]);

    // Post::where('is_admin', 0)->delete();

});

Route::get('/softdelete', function() {

    Post::find(2)->delete();

});

Route::get('/readsoftdelete', function() {

    $posts = Post::onlyTrashed()->get();

    return $posts;

});

Route::get('/restoresoftdelete', function() {

    Post::withTrashed()->where('id', 1)->restore();

});

Route::get('/forcedelete', function() {

    Post::onlyTrashed()->where('id', 3)->forceDelete();

});

/*
|--------------------------------------------------------------------------
| Eloquent Relationships
|--------------------------------------------------------------------------
*/

Route::get('/user/{id}/post/', function($id) {

    return User::find($id)->post;

});

Route::get('post/{id}/user', function($id) {

   return Post::find($id)->user->name;

});

Route::get('/posts', function() {

    $posts = User::find(1)->posts;

    foreach($posts as $post) {

        echo $post->title;
        echo '<br>';

    }

});

Route::get('/user/{id}/role', function($id) {

    $roles = User::find($id)->roles;
//  $roles = User::find($id)->roles()->orderBy('id', 'DESC')->get();

    foreach($roles as $role) {

        echo $role->name;
        echo '<br>';

    }

});

Route::get('/role/{id}/user', function($id) {

    $users = Role::find($id)->users;

    foreach($users as $user) {

        echo $user->name;
        echo '<br>';

    }

});

Route::get('/user/{id}/pivot', function($id) {

    $user = User::find($id);

    foreach ($user->roles as $role) {

        echo $role->pivot->created_at . ' ';

    }

});

Route::get('/user/country/{id}', function($id) {

    $country = Country::find($id);

    foreach ($country->posts as $post) {

        echo $post->title;
        echo '<br>';

    }

});

Route::get('/user/{id}/photos', function($id) {

    $user = User::find($id);

    foreach($user->photos as $photo) {

        echo $photo->path . '<br>';

    }

});

Route::get('/post/{id}/photos', function($id) {

    $post = Post::find($id);

    foreach($post->photos as $photo) {

        echo $photo->path . '<br>';

    }

});