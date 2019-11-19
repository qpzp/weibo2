<!doctype html>
<html>
<head>
    <title>@yield('title','微博') - 电动少女</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('layouts._header')
<div class="container">
    @yield('content')
    @include('layouts._footer')
</div>

</body>
</html>
