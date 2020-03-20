<?php

use App\Address;
use App\Country;
use App\Photo;
use App\Tag;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/example', function () {
    return "Hi you";
});

//Route::get('/post/{id}/{name}', function ($id, $name) {
//    return "This is post number ". $id . " " . $name;
//});

Route::get('/admin/posts/example', array('as'=> 'admin.home', function () {
    $url = route('admin.home');
    return "this url is " . $url;
}));

//Route::get('/posts/{id}', 'PostsController@index');
//

//Route::resource('/posts', 'PostsController');

Route::get('/contact', 'PostsController@contact');

Route::get('post/{id}/{name}/{password}', 'PostsController@showPost');

Route::get('/insert', function() {
    DB::insert('insert into posts(title, body) value(?, ?)', ['PHP with Laravel', 'Laravel is the best thing that has happened to PHP']);
});


Route::get('/read', function() {
    $results = DB::select('select * from posts where id = ?', [1]);
    return var_dump($results);
});

Route::get('/update', function() {
    $updated = DB::update('update posts set title = "Update title" where id = ?', [1]);
    return $updated;
});

Route::get('/delete', function() {
    $deleted = DB::delete('delete from posts where id = ?', [1]);
    return $deleted;
});


// Eloquent ROM
Route::get('/find', function() {
    $posts = Post::all();
    foreach ($posts as $post) {
        return $post->title;
    }
});

Route::get('/findWhere', function() {
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

Route::get('/basicInsert', function() {
    $post = new Post();
    $post->title = "new title";
    $post->body = "new body";

    $post->save();
});

Route::get('/basicInsert2', function() {
    $post = Post::find(2);
    $post->title = "new title2";
    $post->body = "new body2";

    $post->save();
});

// Eloquent relationship
Route::get('/user/{id}/post', function($id){
    return User::find($id)->post;
});

Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user;
});


Route::get('/user/{id}/posts', function($id){
    $user = User::find($id);
    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

Route::get('/user/{id}/role', function($id) {
    $user = User::find($id);
    foreach ($user->roles as $role) {
        return $role->name;
    }
});

// Accessing the intermediate table / pivot
Route::get('user/pivot', function(){
    $user = User::find(1);
    foreach ($user->roles as $role) {
        echo $role->pivot;
    }

});

Route::get('/user/country', function() {
    $country = Country::find(1);
    foreach ($country->posts as $post) {
        return $post;
    }

});


// Polymorphic one to many relation
Route::get('/user/photo', function() {
    $user = User::find(1);
    foreach ($user->photos as $photo) {
        echo $photo . '<br>';
    }
});

Route::get('photo/{id}/post', function($id) {
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

// Polymorphic many to many relation
Route::get('post/tag', function() {
    $post = Post::find(1);
    foreach ($post->tags as $tag) {
        echo $tag->name;
    }
});

Route::get('tag/post', function() {
    $tag = Tag::find(1);
    foreach ($tag->posts as $post) {
        echo $post;
    }
});

// CRUD related data
Route::get('/user/address/insert/', function() {
    $user = User::findOrFail(1);

    $address = new Address(['name'=>'1234 Hourston av NY NY 11218']);

    $user->address()->save($address);
});

Route::get('/user/address/update/', function() {
    $address = Address::whereUserId(1)->first();
    $address->name = "4434 Update Av, alaska";
    $address->save();
    return 'successfully updated';
});
