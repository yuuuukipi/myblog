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
  <a href="{{ url('/') }}">Back</a>
</div>

<form method="post" action="{{ url('/contact/confirm') }}">
  {{ csrf_field() }}

  <p>お名前<br><input type="text" name="name" value="{{old('name')}}">
  @if($errors->has('name'))
    <p style="font-size:14px; margin-top: 0%; padding-top:0%;color:tomato;">※必須項目です</p>
    <span class="error">{{$errors->first('title')}}</span>
  @endif

    <p>email<br><input type="text" name="email" value="{{old('email')}}"></p>
  @if($errors->has('name'))
    <p style="font-size:14px; padding-top:0%;color:tomato;">※必須項目です</p>
    <span class="error">{{$errors->first('title')}}</span>
  @endif

  </p>
  問い合わせ内容<br>
  <p><textarea name="message" class="form-control" rows="5">{{old('message')}}</textarea></p>

  @if($errors->has('name'))
    <p style="font-size:14px; padding-top:0%;color:tomato;">※必須項目です</p>
    <span class="error">{{$errors->first('title')}}</span>
  @endif

  <input type="submit" value="確認" style="margin: 10px;">
</form>

@endsection
