<!doctype html>
<html>
<head>
    <title>@yield('title','微博') - 电动少女</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand" href="/">electric</a>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="/help">帮助</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">登录</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
</body>
</html>
