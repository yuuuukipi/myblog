@extends('layout.app')

@section('content')
<div class="container">
  <div class="row justify-content-senter">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">仮会員登録確認</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">パスワード</label>

                <div class="col-md-6">
                  <span class="">{{$password_mask}}</span>
                  <input type="hidden" name="password" value="{{$password}}">
                </div>
              </div>

              <div class="form-group row md-0">
                <div class="col-md-6 offset-md-4">
                  <button typw="submit" class="btn btn-primary">
                    仮登録
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
