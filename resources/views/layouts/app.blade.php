<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NCBA&E Campus System </title>
    <!-- Fonts 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" >
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" ></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}">
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
<body>
    <nav class="navbar navbar-default navbar-static-top" >
        <div class="container">
            <div class=" navbar-header " id="nav" >
                <!-- Collapsed Hamburger -->
                <!-- Branding Image -->
                <a class="navbar-brand glyphicon glyphicon-star" style=" color: white ;font-size: 23px;" href="{{ url('/') }}">
                    Project-A3I
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse" >
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style=" width: 60%;">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li style=" margin-left: 50%;"><a href="{{ url('/login') }}" style=" color: white ;font-size: 23px;" class=" glyphicon glyphicon-user"> Login</a></li>
                    <!--<li style=" float: right;"><a href="{{ url('/register') }}" style=" color: white ;font-size: 23px;" class=" glyphicon glyphicon-plus"> Register</a></li>-->
                    @else
                    
                    <li class="dropdown" style=" color: white; font-size: 23px;width: 30%;">
                         <div class="dropdown" style=" float: left; margin-top: 5%; margin-right:10px; ">
                             <button class="btn btn-primary dropdown-toggle  glyphicon glyphicon-search" style=" background-color: #d43f3a" type="button" data-toggle="dropdown"> Modules 
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('/visitor')}}">Visitors</a></li>
                                    <li><a href="{{url('/student')}}">Students</a></li>
                                    <li><a href="#">Faculty</a></li>
                                    <li><a href="#{{url('/admission')}}">Admissions</a></li>
                                    <li><a href="#{{url('/program')}}">Programs</a></li>
                                    <li><a href="#{{url('/department')}}">Department</a></li>
                                </ul>
                         </div>
                    </li>
                    
                    <li class="dropdown" style=" color: white; font-size: 23px;width: 30%;">
                         <div class="dropdown" style=" float: left; margin-top: 5%; margin-right:10px; ">
                             <button class="btn btn-primary dropdown-toggle  glyphicon glyphicon-search" style=" background-color: #d43f3a" type="button" data-toggle="dropdown"> User Auhentication 
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/home') }}">Home</a></li>
                                    <li><a href="{{ route('users.index') }}">Users</a></li>
                                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                                    <li><a href="{{ route('itemCRUD2.index') }}">Items</a></li>
                                    
                                </ul>
                         </div>
                    </li>
                    
                    <li style=" color: white; width: 33%; margin-top: 20px;" class="pull-right">
                        <div style=" ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  style=" color: white;" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret" ></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" style="">
                                <li style="">
                                    <a href="{{ url('/logout') }}" style=""><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
                        
                        
                  
            </div>
        </div>
    </nav>
    <div class=" container">
    @yield('content')
    </div>
   

    <!-- JavaScripts -->
    
    
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>
</body>
</html>