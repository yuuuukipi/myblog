@extends('layouts.app')

@section ('title', 'New Post')

@section('content')
<p style="text-indent: 1em;"></p>
<h3>新規投稿</h3>

<div class="text-right">
  <a href="{{ url('/') }}">戻る</a>
</div>
<form method="post" action="{{ url('/post/confirm') }}">
  {{ csrf_field() }}
  <p>
    @guest
      <p>会員登録をしてください</p>
      <p><a href="{{ url('/register') }}" class="btn btn-primary" role="button">会員登録</a></p>
      <p><a href="{{ url('/login') }}" class="btn btn-primary" role="button">ログイン</a></p>
    @else
      <div style="padding: 20px 0px;">名前: {{ Auth::user()->name }}</div>
      タイトル
      <input type="text" name="title" placeholder="タイトル" class="form-control" style="margin: 10px;" value="{{old('title') }}">
      @if ($errors->has('title'))
        <span style="color:tomato;">{{ $errors->first('title')}}</span>
      @endif
        内容
        <textarea name="body" placeholder="内容を記載してください" class="form-control" rows="5" style="margin: 10px;" >{{ old('body') }}</textarea>
      @if ($errors->has('body'))
        <span style="color:tomato;">{{ $errors->first('body')}}</span>
      @endif
      <div></div>
        <input type="submit" value="確認" style="margin: 10px;">
    @endguest
  </p>
</form>

@endsection
