<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
</head>
<body>

@if(!request()->routeIs("login"))
    @include("layout.navbar")
@endif

@yield("content")

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
