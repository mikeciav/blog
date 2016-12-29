<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body style='padding-top:80px;'>

        <nav class="navbar navbar-default navbar-fixed-top">
            @include('partials.navbar')
        </nav>

        @include('partials.messages')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
        </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="/js/app.js"></script>
    <script src="/js/select2.min.js"></script>
    <!--Disqus-->
    <script id="dsq-count-scr" src="//ragareport.disqus.com/count.js" async></script>
    @yield('scripts');
</body>
</html>
