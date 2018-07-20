@extends('layouts.app')

@section ('title')
@section('content')

<div class="container">
  <p style="text-indent: 1em;"></p>
  <div class="form-inline">
    <h3>投稿 確認画面</h3>
  </div>
</div>

<div class="text-right">
  <a href="{{ url('/contact') }}">戻る</a>
</div>

<div style="font-size:18px;">お名前:</div>
<div style="font-size:16px;">{{ Auth::user()->name }}</div><br>
<div style="font-size:18px;">タイトル:</div>
<div style="font-size:16px;">{{$title}}</div><br>
<div style="font-size:18px;">内容:</div>
<div style="font-size:16px;">{!! nl2br($body) !!}</div><br>

<div class="form-inline">
  <form method="post" action="{{ url('/post/complete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{$token}}">
    <input type="submit" name="action"  value="入力画面に戻る" style="margin: 10px;">
    <input type="submit" name="action"  value="送信" style="margin: 10px;">
  </form>
</div>


@endsection
