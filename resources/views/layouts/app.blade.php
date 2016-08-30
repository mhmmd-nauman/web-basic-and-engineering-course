<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        
        .navbar-default{background-color:#ac2925}
        
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" >
        <div class="container">
            <div class=" navbar-header " id="nav" >

                <!-- Collapsed Hamburger -->
                

                <!-- Branding Image -->
                <a class="navbar-brand glyphicon glyphicon-star" style=" color: white ;font-size: 23px;" href="{{ url('/') }}">
                    Bear Project
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" >
                <!-- Left Side Of Navbar -->
<!--                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style=" width: 60%;">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li style=" margin-left: 50%;"><a href="{{ url('/login') }}" style=" color: white ;font-size: 23px;" class=" glyphicon glyphicon-user"> Login</a></li>
                    <li style=" float: right;"><a href="{{ url('/register') }}" style=" color: white ;font-size: 23px;" class=" glyphicon glyphicon-plus"> Register</a></li>
                    @else
                    
                    <li class="dropdown" style=" color: white; font-size: 23px;width: 30%;">
                         <div class="dropdown" style=" float: left; margin-top: 5%; margin-right:10px; ">
                             <button class="btn btn-primary dropdown-toggle  glyphicon glyphicon-search" style=" background-color: #d43f3a" type="button" data-toggle="dropdown"> View Record 
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/bear')}}">Bears Record</a></li>
                                    <li><a href="#">Bears-Picnic Record</a></li>
                                    <li><a href="{{url('/fish')}}">Fish Record</a></li>
                                    <li><a href="{{url('/picnic')}}">Picnic Record</a></li>
                                    <li><a href="{{url('/tree')}}">Tree Record</a></li>
                                </ul>
                         </div>
                    </li>
                    <li style=" color: white; font-size: 23px;width: 30%;">
                        <div class="dropdown" style=" float: left; margin-top: 5%; ">
                            <button class="btn btn-primary dropdown-toggle glyphicon glyphicon-pencil" style=" background-color: #d43f3a" type="button" data-toggle="dropdown"> Insert New Record
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Insert Bears Record</a></li>
                                    <li><a href="#">Insert Bears-Picnic Record</a></li>
                                    <li><a href="#">Insert Fish Record</a></li>
                                    <li><a href="#">Insert Picnic Record</a></li>
                                    <li><a href="#">Insert Tree Record</a></li>
                                </ul>
                        </div>
                    </li>
                    <li style=" color: white; font-size: 23px;width: 33%;">
                        <div style=" float: right; ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  style=" color: white; font-size: 23px; float: right" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret" ></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" style=" float: right;">
                                <li style="background-color: black; float: right"><a href="{{ url('/logout') }}" style=" color: white ;font-size: 23px;"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
                        
                        
                  
            </div>
        </div>
    </nav>

    @yield('content')
    
   

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
