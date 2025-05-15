<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Weibo App') - Laravel blog</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
@include('layouts._header')

<div class="container">
    @include('shared._messages')
    @yield('content')

    @include('layouts._footer')

</div>
</body>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.classList.add('fade');
            el.classList.remove('show');
            setTimeout(() => el.remove(), 500); // 动画结束后移除元素
        });
    }, 2000); // 3 秒后开始淡出
</script>

</html>
