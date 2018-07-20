@extends('layouts.app')

@section ('title', 'Edit Post')

@section('content')
<h3>
  記事編集
</h3>
<div class="text-right">
  <a href="{{ url('/posts', $post->id) }}" class="header-menu">戻る</a>
</div>
<form method="post" action="{{ url('/posts', $post->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>タイトル
    <input type="text" name="title" placeholder="enter title" class="form-control" value="{{old('title', $post->title) }}">
    @if ($errors->has('title'))
      <span class="error">{{ $errors->first('title')}}</span>
    @endif
  </p>

  <p>内容
    <textarea name="body" placeholder="enter body" class="form-control" rows="5">{{ old('body', $post->body)}}</textarea>
    @if ($errors->has('body'))
    <span class="error">{{ $errors->first('body')}}</span>
    @endif
  </p>

  <p>
    <input type="submit" value="更新">
  </p>


</form>

@endsection
