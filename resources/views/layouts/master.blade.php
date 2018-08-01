<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="keywords" content="磁力吧,磁力链接,磁力搜索,种子搜索,bt,电影" />
    <meta name="description" content="全球最大的高清电影磁力种子搜索库" />
    <link rel="stylesheet" href="/css/app.css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    @yield('content')
<script src="/js/app.js"></script>
</body>
@yield('script')
</html>
