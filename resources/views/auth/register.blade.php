@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">仮会員登録</div>

                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ route('register.pre_check') }}">
                      {{ csrf_field() }}

                  {{--
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="name" class="col-md-4 control-label">名前</label>
                      <div class="col-md-6">
                          <input
                              id="name" type="text"
                              class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                              name="name" value="{{ old('name') }}" required>

                          @if ($errors->has('name'))
                              <span class="invalid-feedback">
                              <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div><br>
                  --}}
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-md-4 control-label">E-Mailアドレス</label>

                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div><br>

                  {{--
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">パスワード</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="password" required>

                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div><br>

                  <div class="form-group">
                      <label for="password-confirm" class="col-md-4 control-label">パスワード確認</label>

                      <div class="col-md-6">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                      </div>
                  </div><br><br>
                  --}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    確認画面へ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
