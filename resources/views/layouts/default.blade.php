<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title', config('app.name', 'liangjingwu'))</title>
</head>
<body>
@yield('content')
</body>
</html>
