<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>

<body style='padding-top:80px;'>

        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
            @include('partials.navbar')
        </nav>

        @include('partials.messages')
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @yield('content')
                </div>
                <div class="col-md-3">
                    @include('partials.sidebar')
                </div>
            </div>
        </div>

    @include('partials.footer')

    <!-- Scripts -->
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="/js/app.js"></script>
    <script src="/js/select2.min.js"></script>
    <!--Share This-->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=9e3aead6-c9ca-4095-a708-9bc6702cdfcf"></script>
    <script type="text/javascript">stLight.options({publisher: "9e3aead6-c9ca-4095-a708-9bc6702cdfcf", doNotHash: true, doNotCopy: false, shorten: false});</script>
    @yield('scripts');
</body>
</html>
