<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('name')</title>

    <!-- STYLE -->
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    <!-- NAVBAR -->
    @include('includes.navbar-auth')

    <!--Page Content-->
    @yield('content')

    <!-- FOOTER -->
    @include('includes.footer')

    <!--SCRIPT-->
    @stack('prepend-script')
    @include('includes.script')

    @stack('addon-script')
</body>

</html>
