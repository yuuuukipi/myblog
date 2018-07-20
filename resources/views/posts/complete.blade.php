@extends('layouts.app')

@section ('title', '投稿')
@section('content')

<div class="container">
  <p style="text-indent: 1em;"></p>
    <div class="form-inline">
      <h3>投稿完了画面</h3>


    </div>
</div>

<div class="text-right">
  <a href="{{ url('/') }}">Top画面へ</a>
</div>

<div style="font-size:17px;">投稿が完了しました。</div><br>
<br>

@endsection
