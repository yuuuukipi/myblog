<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>@yield('掲示板')</title>
  <a class="navbar-brand" href="{{ url('/') }}">掲示板</a>
  <!-- <link rel="stylesheet" href="/css/styles.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

</head>
<body>
  <div class="container">
    @yield('content')
    </div>
</body>
</html>
