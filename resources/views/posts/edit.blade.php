@extends('layouts.default')

@section ('title', 'Edit Post')

@section('content')
<h1>
  Edit Post
</h1>
<div class="text-right">
  <a href="{{ url('/') }}" class="header-menu">Back</a>
</div>
<form method="post" action="{{ url('/posts', $post->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>
    <input type="text" name="title" placeholder="enter title" class="form-control" value="{{old('title', $post->title) }}">
    @if ($errors->has('title'))
      <span class="error">{{ $errors->first('title')}}</span>
    @endif
  </p>

  <p>
    <textarea name="body" placeholder="enter body" class="form-control" rows="5">{{ old('body', $post->body)}}</textarea>
    @if ($errors->has('body'))
    <span class="error">{{ $errors->first('body')}}</span>
    @endif
  </p>

  <p>
    <input type="submit" value="Update">
  </p>


</form>

@endsection
