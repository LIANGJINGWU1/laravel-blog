<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>确认链接</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">感谢注册！</h1>

        <p class="mb-4 text-gray-700">
            请点击以下链接完成账户激活：
        </p>

        <div class="text-center mb-6">
            <a href="{{ route('confirm_email', $user->activation_token) }}"
               class="inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition">
                立即确认邮箱
            </a>
        </div>

        <div class="text-sm text-gray-500 text-center">
            如果您没有注册账号，请忽略此邮件。
        </div>
    </div>
</div>
</body>
</html>
{{--</<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>确认链接</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--    <p>感谢注册</p>--}}
{{--    <p>--}}
{{--        请点击一下链接注册--}}
{{--        <a href="{{ route('confirm_email', $user->activation_token) }}">--}}
{{--            {{ route('confirm_email', $user->activation_token) }}--}}
{{--        </a>--}}
{{--    </p>--}}
{{--    <p>--}}
{{--        如果不是您本人，请无视。--}}
{{--    </p>--}}
{{--</body>--}}
{{--</html>--}}
