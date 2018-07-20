@extends('layouts.app')

@section ('title', $post->title)

@section('content')
<p style="text-indent: 1em;"></p>
  <div class="text-right">
    <a href="{{ url('/') }}">戻る</a>
  </div>
<div class="card">
  <p class="h3">No.{{ $post->id }}
  {{ $post->title }}</p>
  <p class="h6">
    <a href="{{ action('UsersController@show',$post->user->id)}}">{{ $post->user->name }}</a>

    最終更新日: {{ $post->updated_at->format('Y/m/d h:i') }}
    </p><br>
  {!! nl2br(e($post->body)) !!}
  <div class="text-right">
    作成日: {{ $post->created_at->format('Y/m/d h:i') }}
    <a href="{{ action('PostController@edit', $post)}}" >[編集]</a>
    <a href="#" class="del" data-id="{{ $post->id }}">[削除]</a>
    <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
  </div>

</div>

<h4>コメント</h4>

<form method="post" action="{{ action('CommentsController@store', $post) }}">
  {{ csrf_field() }}
  <p>
    @guest
    コメントするには会員登録をしてください
    <a href="{{ url('/register') }}" style="color:blue;">→会員登録はこちら</a>

    @else
      <div>名前: {{ Auth::user()->name }}</div>
      <input type="text" name="body" placeholder="コメント" class="form-control" rows="3" value="{{old('body') }}">
      @if ($errors->has('body'))
        <span class="error">{{ $errors->first('body')}}</span>
      @endif
    </p>
    <p>
      <input type="submit" value="送信">
    </p>
  @endguest


</form>

    @forelse ($post->comments as $comment)
    <div class="card">
      <p>{{ $comment->user->name }}</p>
        <p>{{ $comment->body}}</p>
        <div class="text-right">{{ $comment->created_at->format('Y/m/d h:i') }}　
        <a href="#" data-id="{{ $comment->id }}" class="pull-right del">[削除]</a>
        <form method="post" action="{{ action('CommentsController@destroy', [$post, $comment] )}}" id="form_{{ $comment->id }}">
          {{ csrf_field() }}
          {{ method_field('delete') }}
        </form>
      </div>
    </div>

    @empty
      <p>No comments yet</p>
    @endforelse

{{--
<h2>コメント</h2>
  <table class="table-bordered">
    @forelse ($post->comments as $comment)
    <tr>
      <td class="col-sm-10">
        <p>{{ $comment->user->name }}</p>
        <p>{{ $comment->body}}</p>
      </td>
      <td class="col-sm-2">
        <a href="#" data-id="{{ $comment->id }}" class="pull-right del">[削除]</a>
        <form method="post" action="{{ action('CommentsController@destroy', [$post, $comment] )}}" id="form_{{ $comment->id }}">
          {{ csrf_field() }}
          {{ method_field('delete') }}
        </form>
      </td>
    </tr>

    @empty
      <p>No comments yet</p>
    @endforelse
  </table>
--}}


<script src="/js/main.js"></script>

@endsection
