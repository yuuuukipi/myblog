<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    public function store(Request $request, Post $post){
      $this->validate($request, [
        'body' => 'required'
      ]);
      $comment=new Comment(['body' => $request->body, 'user_id' => Auth::user()->id]);
      $post->comments()->save($comment);
      return redirect()->action('PostController@show', $post);
    }

    public function destroy(Post $post, Comment $comment) {
      $comment->delete();
      return redirect()->back();
    }
}
