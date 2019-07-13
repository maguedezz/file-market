<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include ('layouts.partials._head')
</head>
<body>

        @yield('content')

    @include ('layouts.partials._scripts')
</body>
</html>
