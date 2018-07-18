@extends('layouts.default')

@section ('title', $user->name)

@section('content')

  <p style="text-indent: 1em;"></p>
  <h1 style="font-size: 25px; color:gray;">
      ユーザー情報
  </h1>
  <div class="text-right">
    <a href="{{ url('/') }}">Back</a>
  </div>
  <h2 style="font-size:20px;">{{ $user->name }}</h2><br>
  <p>--- 投稿記事一覧 ---</p>
  @forelse ($user->posts as $post)
    <a href="{{ action('PostController@show', $post)}}">{{ $post->title }}</a><br>
  @empty
    <li>投稿記事はありません</li>
  @endforelse

@endsection
