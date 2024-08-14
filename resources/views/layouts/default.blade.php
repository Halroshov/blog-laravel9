<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Weibo')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('layouts._header')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="offset-md-1 col-md-10">

    @yield('content')

    @include('layouts._footer')

    </div>
</div>
</body>
</html>