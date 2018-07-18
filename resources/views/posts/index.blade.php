@extends('layouts.default')

@section ('title', 'Blog Posts')

@section('content')
<div class="container">
  <p style="text-indent: 1em;"></p>
    <div class="form-inline">
      <h1>Posts!!!</h1>
    </div>

    <div class="text-right" style="padding: 10px">
      @guest
        <div class="text-right" style="padding: 10px">
          <a href="{{ url('/posts/create') }}" class="btn btn-info" role="button">New Post</a>
          <a href="{{ url('/login') }}" class="btn btn-primary" role="button">login</a>
          <a href="{{ url('/register') }}" class="h6">会員登録はこちら</a>
        </div>
      @else
        <div class="text-right" style="padding: 10px">
          <a href="{{ url('/posts/create') }}" class="btn btn-info" role="button">New Post</a>
        </div>
        会員情報: {{ Auth::user()->name }} (ID: {{ Auth::user()->id }} )
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      @endguest
      </div>

  <ul>
    @forelse ($posts as $post)
    <div class="card">
      <div class="alert alert-secondary" role="alert">
        <div class="form-inline">
          <p>No.{{ $post->id }}
            <a href="{{ action('PostController@show', $post)}}">{{ $post->title }}</a>
          </p>
        </div>
        <p>コメント数:{{ count($post->comments) }}</p>
        <div class="text-right">
          <p>作成者:{{ $post->user->name }}</p>
          <p>最終更新日:{{ $post->updated_at }}</P>
        </div>

        @guest
        @else
          <div class="text-right">
            <a href="{{ action('PostController@edit', $post)}}" >[編集]</a>
            <a href="#" class="del" data-id="{{ $post->id }}">[削除]</a>
            <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
              {{ csrf_field() }}
              {{ method_field('delete') }}

            </form>
          </div>
        @endguest
      </div>
    </div>
     @empty
    <li>No posts yet</li>
    @endforelse
  </ul>
  <div class="text-right">
    <a href="{{ action('ContactController@index')}}">お問い合わせ</a><br><br>
  </div>
  <script src="/js/main.js"></script>
</div>
@endsection
