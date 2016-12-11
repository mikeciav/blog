<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body style='padding-top:100px;'>

        <nav class="navbar navbar-default navbar-fixed-top" style='padding-top: 40px;'>
            @include('partials.navbar')
        </nav>

        @yield('content')

    @include('partials.footer')

    <!-- Scripts -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="/js/app.js"></script>
    <script src="/js/select2.min.js"></script>
    @yield('scripts');
</body>
</html>
