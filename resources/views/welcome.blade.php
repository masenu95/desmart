
<!DOCTYPE html>
<html>

<head>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    

	 <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desmartlife') }}</title>

	<!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


	 <link rel="stylesheet" href="{{asset('css/home.css')}}">



</head>

<body>
    <nav>
        <div class="logo ">
            <a href=""><img src="images/logo.png"></a>
        </div>
            <div class="auth-section">
            <ul>
                @guest
                    <li><a href="{{ url('login') }}" class="login-link">Login</a></li>
                    <li><a href="{{ url('register') }}" class="reg-link">Register</a></li>
                    @else
                    <li> 
                        <a href="#" aria-haspopup="true" class="login-link" aria-expanded="false" v-pre onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                @endguest
          
            </ul>
            </div>
       
    </nav>
    <div class="container home-content">
       
        <div class="row animated slideInDown">
            <div class="col-lg-6 col-md-6 col-sm-12 animated slideInLeft">

                <a href="{{ url('Market') }}">
                    <div class="card-home">
                        <i class="fas fa-store"></i> SMART MARKET
                    </div>
                </a>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 animated slideInRight">

                <a href="{{ url('Investment') }}">
                    <div class="card-home">
                        <i class="fas fa-chart-line"></i> SMART INVESTORS
                    </div>
                </a>
            </div>
        </div>
        <div class="row animated slideInUp">
            <div class="col-lg-6 col-md-6 col-sm-12 animated slideInLeft">
                <a href="{{ url('search') }}">
                    <div class="card-home">
                        <i class="fas fa-search"></i>SMART SEARCH
                    </div>
                </a>
            </div>
         
         
                <div class="col-lg-6 col-md-6 col-sm-12 animated slideInRight">
                    <a href="{{ url('about') }}">
                        <div class="card-home">
                            <i class="fas fa-address-card"></i></i>ABOUT US
                        </div>
                    </a>
                </div>

          

        </div>
       

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>



    <script src="js/forum.js"></script>
</body></html>
