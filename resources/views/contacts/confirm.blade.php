@extends('layouts.default')

@section ('title', 'お問い合わせ')
@section('content')

<div class="container">
  <p style="text-indent: 1em;"></p>
  <div class="form-inline">
    <h1 style="font-size:30px; color:gray;">お問い合わせフォーム 確認画面</h1>
  </div>
</div>

<div class="text-right">
  <a href="{{ url('/contact') }}">Back</a>
</div>

<div style="font-size:18px;">お名前:</div>
<div style="font-size:16px;">{{$name}}</div><br>
<div style="font-size:18px;">email:</div>
<div style="font-size:16px;">{{$email}}</div><br>
<div style="font-size:18px;">問い合わせ内容:</div>
<div style="font-size:16px;">{!! nl2br($message) !!}</div><br>

<div class="form-inline">
  <form method="post" action="{{ url('/contact/complete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{$token}}">
    <input type="submit" name="action"  value="入力画面に戻る" style="margin: 10px;">
    <input type="submit" name="action"  value="送信" style="margin: 10px;">
  </form>
</div>


@endsection
