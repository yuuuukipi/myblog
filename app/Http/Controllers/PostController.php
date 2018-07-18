<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index() {
      $posts = Post::latest()->get();
      // dd($posts->toArray());
      return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post) {
      // $post = Post::findOrFail($id);
      return view('posts.show')->with('post', $post);
    }

    public function create() {
      return view('posts.create');
    }

    public function store(PostRequest $request) {
      $post = new Post();
      $post->title = $request->title;
      $post->user_id = Auth::user()->id;
      $post->body = $request->body;
      $post->save();
      return redirect('/');
    }

    public function edit(Post $post) {
      return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $request, Post $post) {
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('/');
    }

    public function destroy(Post $post) {
      $post->delete();
      return redirect('/');
    }

}
