<html>
<head>
    <meta charset="UTF-8">
    <title>注册确认链接</title>
</head>
<body>
<h1>感谢您对电动少女的支持，并注册了该网站用户</h1>
<p>
    请点击下面的链接完成注册
    <a href="{{route('confirm_email',$user->activation_token)}}">
        {{route('confirm_email',$user->activation_token)}}
    </a>
</p>
<p>如果这不是您本人操作，请忽略。</p>
</body>
</html>
