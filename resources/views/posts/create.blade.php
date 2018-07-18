@extends('layouts.default')

@section ('title', 'New Post')

@section('content')
<p style="text-indent: 1em;"></p>
<h1>New Post</h1>

<div class="text-right">
  <a href="{{ url('/') }}">Back</a>
</div>
<form method="post" action="{{ url('/posts') }}">
  {{ csrf_field() }}
  <p>
    @guest
      <p>会員登録をしてください</p>
      <p><a href="{{ url('/register') }}" class="btn btn-primary" role="button">会員登録</a></p>
      <p><a href="{{ url('/login') }}" class="btn btn-primary" role="button">ログイン</a></p>
    @else
      <div style="padding: 20px;">name: {{ Auth::user()->name }}</div>
      <input type="text" name="title" placeholder="enter title" class="form-control" style="margin: 10px;" value="{{old('title') }}">
      @if ($errors->has('title'))
        <span style="color:tomato;">{{ $errors->first('title')}}</span>
      @endif
        <textarea name="body" placeholder="enter body" class="form-control" rows="5" style="margin: 10px;" >{{ old('body') }}</textarea>
      @if ($errors->has('body'))
        <span style="color:tomato;">{{ $errors->first('body')}}</span>
      @endif
      <div></div>
        <input type="submit" value="Add" style="margin: 10px;">
    @endguest
  </p>



</form>

@endsection
