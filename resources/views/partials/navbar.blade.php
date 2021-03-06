<div class="container-fluid">
    <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" >
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img height='50px' src="/logo.png" style='margin-top:-10px'>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
        <li>
            <span>&nbsp;&nbsp;&nbsp;</span>
        </li>
        <a class="navbar-brand">
            <small style='vertical-align: -20%'><strong>Quality</strong> Counter-Strike Journalism</small>
        </a>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
                <li class="{{Request::is('favorites')?'active':''}}"><a href="{{ route('favorites', Auth::id()) }}">Favorites</a></li>
            @endif
            @if(Auth::user() && Auth::user()->isAdmin())
                <li class="{{Request::is('posts')?'active':''}}"><a href="{{ route('posts.create') }}">Create Post</a></li>
            @endif
            <li class='dropdown'>
                <a class='dropdown-toggle' data-toggle="dropdown" href="#">Browse&nbsp;<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{Request::is('teams')?'active':''}}"><a href="{{ route('teams.index') }}">Teams</a></li>
                    <li class="{{Request::is('players')?'active':''}}"><a href="{{ route('players.index') }}">Players</a></li>
                    <li class="{{Request::is('categories')?'active':''}}"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="{{Request::is('tags')?'active':''}}"><a href="{{ route('tags.index') }}">Tags</a></li>
                </ul>
            </li>
            <li style='padding-top:7px;, padding-bottom:-2px; padding-right:5px; padding-left:5px'>
                <form method='get' role='form' action="{{ url('/') }}">
                    {{csrf_field()}}
                    <div class="form-group has-feedback">
                        <input type="search" name='query' id='query' class='form-control' placeholder='Search' style='width:300px; height:40px; border-radius:20px; margin-bottom:-7px'>
                        <i class="glyphicon glyphicon-search form-control-feedback"></i>
                    </div>
                </form>                
            </li>
            <!-- Authentication Links -->
            @if ( ! (Auth::guest()) )
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>