@extends('layouts.app')

@section ('title', 'お問い合わせ')
@section('content')

<div class="container">
  <p style="text-indent: 1em;"></p>
    <div class="form-inline">
      <h3>お問い合わせフォーム</h3>
    </div>
</div>

<div class="text-right">
  <a href="{{ url('/') }}">Top画面へ</a>
</div>

<div style="font-size:16px;">送信完了しました。</div><br>
<div style="font-size:16px;">メールをご確認お願いします。</div>
<br>

@endsection
