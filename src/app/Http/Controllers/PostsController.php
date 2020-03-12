<?php


namespace App\Http\Controllers;


class PostsController extends Controller
{
    public function index($id) {
        return "it works". $id;
    }

    public function store() {

    }

    public function create() {

    }

    public function showPost($id, $name, $password) {
//        return view('post')->with('id', $id);
        return view('post', compact('id', 'name', 'password'));
    }

    public function update() {

    }

    public function destroy() {

    }

    public function edit() {

    }

    public function contact() {
        return view('contact');
    }

}
