@extends('layouts.default')

@section ('title', $post->title)

@section('content')
<p style="text-indent: 1em;"></p>
<h1>
Posts!!!
</h1>
  <div class="text-right">
    <a href="{{ url('/') }}">Back</a>
  </div>

<div class="card border-info mb-3" style="color:;">
  <p class="h3">No.{{ $post->id }}
  {{ $post->title }}</p>
  {{--<p style="border-top: 3px dotted #f45e5e;"></p>--}}
  <p class="h6">
    <a href="{{ action('UsersController@show',$post->user->id)}}">{{ $post->user->name }}</a>

    最終更新日: {{ $post->updated_at }}
    </p><br>
  {!! nl2br(e($post->body)) !!}
  <div class="text-right">
    作成日: {{ $post->created_at }}
    <a href="{{ action('PostController@edit', $post)}}" >[編集]</a>
    <a href="#" class="del" data-id="{{ $post->id }}">[削除]</a>
    <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
  </div>

</div>

<h2>Comments</h2>
  <table class="table-bordered">
    @forelse ($post->comments as $comment)
    <tr>
      <td class="col-sm-11">
        <p style="font-size:90%">{{ $comment->user->name }}
        </p>
        <p style="font-size:98%">{{ $comment->body}}</p>
      </td>
      <td class="col-sm-1">
        <a href="#" data-id="{{ $comment->id }}" class="pull-right del">[x]</a>
        <form method="post" action="{{ action('CommentsController@destroy', [$post, $comment] )}}" id="form_{{ $comment->id }}">
          {{ csrf_field() }}
          {{ method_field('delete') }}
        </form>
      </td>
    </tr>

    @empty
      <p>No comments yet</p>
    @endforelse
  </table>



<form method="post" action="{{ action('CommentsController@store', $post) }}">
  {{ csrf_field() }}
  <p>
    @guest
    コメントするには会員登録をしてください
    <a href="{{ url('/register') }}" style="color:blue;">→会員登録はこちら</a>

    @else
      <div>name: {{ Auth::user()->name }}</div>
      <input type="text" name="body" placeholder="enter comment" class="form-control" rows="3" value="{{old('body') }}">
      @if ($errors->has('body'))
        <span class="error">{{ $errors->first('body')}}</span>
      @endif
    </p>
    <p>
      <input type="submit" value="Add Comment">
    </p>
  @endguest


</form>
<script src="/js/main.js"></script>

@endsection
