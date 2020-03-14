<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/post/{id}/{name}', function ($id, $name) {
    return "This is post number ". $id . " " . $name;
});

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
