<!DOCTYPE html>
<html lang="ja">
<body style="font-size:13px;">
  <br>{{$name}}様<br><br>
  お問い合わせいただき誠にありがとうございます。<br>
  お問い合わせいただいた内容は下記の通りです。<br>
  ご確認ください。<br>
{{--dd($contact->email)--}}

  <br>-----------------------------------------------------------<br>
  <p>【お名前】<br>{{$name}}</p>
  <p>【メールアドレス】<br>{{$contact->email}}</p>
  <p>【お問い合わせ内容】<br>{!! nl2br($contact->message) !!}</p>
  -----------------------------------------------------------<br><br>
  メールでの返信を今しばらくお待ち下さい。<br>
<div>Posts!!!</div>
</body>
</html>
