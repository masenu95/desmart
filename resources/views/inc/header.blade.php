<header>
    <!-- top Header -->
    <div id="top-header">
        <div class="container">
            <div class="pull-left">
                <span>Welcome to Smart Market</span>
            </div>
        </div>
    </div>
    <!-- /top Header -->

    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <a class="logo" href="/">
                        <img src="{{asset('images/logo.png')}}" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Search -->

                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <strong class="text-uppercase" style="font-size:14px">My Account </strong>
                        </div>
                        @guest
                        <a href="{{ route('login') }}" class="text-uppercase">Login</a>
                        @else
                        <h6 class="user-name" style="font-size:14px;margin-top:2px;">{{ Auth::user()->name }}</h6>
                        @endguest

                        <ul class="custom-menu animated flipInY">
                            @if(Auth::check())
                            @if(Auth::user()->role_id==1)
                            <li><a href="{{ url('/home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            @endif
                            <li><a href="{{ url('Profile/'.Auth::user()->id) }}"><i class="fa fa-user-o"></i>Profile</a></li>
                            <li><a href="#"><i class="fas fa-ad"></i> My Ad</a></li>
                            <li><a href="#" aria-haspopup="true" aria-expanded="false" v-pre onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> Logout</a></li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                            <li><a href="{{route('login')}}"><i class="fa fa-unlock-alt"></i> Login</a></li>
                            @endif
                        </ul>
                    </li>
                    <!-- /Account -->

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>
