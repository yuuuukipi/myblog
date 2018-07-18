@extends('layouts.default')

@section ('title', 'お問い合わせ')
@section('content')

<div class="container">
  <p style="text-indent: 1em;"></p>
    <div class="form-inline">
      <h1 style="font-size:30px; color:gray;">お問い合わせフォーム</h1>
    </div>
</div>

<div class="text-right">
  <a href="{{ url('/') }}">Top</a>
</div>

<div style="font-size:20px;">送信完了しました。</div><br>
<div style="font-size:20px;">メールをご確認お願いします。</div>
<br>

@endsection
