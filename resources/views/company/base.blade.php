<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}"/>
</head>
<body>
<div class="container px-2 py-2">
    @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
