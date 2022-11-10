<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')
</head>

<body class="antialiased">
@yield('header')
@yield('content')
@yield('footer')
</body>
</html>
