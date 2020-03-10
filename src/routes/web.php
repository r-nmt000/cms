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

Route::get('/posts', 'PostsController@index');

