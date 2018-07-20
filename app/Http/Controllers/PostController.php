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
      // $users = DB::table('users')->paginate(15);
      // $posts = Post::paginate(5);
      // $posts = Post::latest()->paginate(5);
      $posts = Post::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(5);
      // dd($posts->toArray());
      // dd(Auth::user());
      return view('posts.index')->with('posts', $posts);
    }

    public function show(Post $post) {
      // $post = Post::findOrFail($id);
      return view('posts.show')->with('post', $post);
    }

    public function create() {
      return view('posts.create');
    }

    public function confirm(Request $request){
      $token = md5(uniqid(rand(), true));
      // $request->session()->put('name', $request->input('name'));
      $request->session()->put('title', $request->input('title'));
      $request->session()->put('body', $request->input('body'));
      $request->session()->put('token', $token);
      //dd($request->session());

      // $name = $request->session()->get('name');
      $title = $request->session()->get('title');
      $body = $request->session()->get('body');
      // dd($title);

      $this->validate($request, [
        // 'name' => 'required',
        'title'=>'required',
        'body'=>'required',
      ]);
      // dd(Auth::user());


      return view('posts.confirm')
      // ->with(['title'=>$title,'body'=>$body]);
        ->with(['title'=>$title,'body'=>$body,'token'=>$token]);

    }


    public function store(Request $request) {

      $action=$request->get('action','back');
      $post_token=$request->get('token');

      if($action === '送信'){
        if($request->session()->get('token') !== $post_token){
          return redirect('/');
        }
      $post = new Post();

      $post->title = session()->get('title');
      $post->body = session()->get('body');
      $post->user_id = Auth::user()->id;
      $post->save();
      // $request->session()->flush();
      $request->session()->forget('title');
      $request->session()->forget('body');
      $request->session()->forget('token');

      return view('posts.complete');

    }else{

      return redirect()->action('PostController@create')
      ->withInput([
        'title'=>session()->get('title'),
        'body'=>session()->get('body'),
      ]);
    }

    }



    public function edit(Post $post) {
      return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $request, Post $post) {
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      // return redirect('/');
      return redirect(url('posts', [$post->id]));
      // return redirect()->route('post', ['id' => 1]);
    }

    public function destroy(Post $post) {
      $post->delete();
      return redirect('/');
    }

}
