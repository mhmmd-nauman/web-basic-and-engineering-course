<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NCBA&E Campus System </title>
    <!-- Fonts --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('js/DataTables-1.10.13/media/css/jquery.dataTables.css') }}" >
    <!--
    <link rel="stylesheet" type="text/css" href="{{ asset('js/DataTables-1.10.13/examples/resources/syntax/shCore.css') }}">
     
    <link rel="stylesheet" type="text/css" href="{{ asset('js/DataTables-1.10.13/examples/resources/demo.css') }}">
    -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" ></script>
    
    <script src="{{ asset('js/DataTables-1.10.13/media/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/DataTables-1.10.13/examples/resources/syntax/shCore.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/DataTables-1.10.13/examples/resources/demo.js') }}"></script>
    
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
        .navbar-default{
            background-color: #d43f3a;
            margin: 5px;
            color: white;
        }
        .navbar-nav-link { color: white;}
        .top_bar {
            background-color: #d43f3a;
        }
    </style>
</head>
<body>
    
    <div class="container" >
            <div class="row">
                <div class="col-md-12 top_bar" >
                    
                    <nav class = "navbar navbar-default col-md-9" role = "navigation">
   
                    <div class = "navbar-header">
                       <a class = "navbar-brand" href = "{{url('/')}}" style="color:white;">Project-A3I</a>
                    </div>

                    <div>
                       <ul class = "nav navbar-nav pull-right">
                           <li><a href = "#" style="color:white;">System</a></li>
                           <li><a href = "#" style="color:white;">Settings</a></li>

                          <li class = "dropdown">
                             <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" style="color:white;">
                                Modules 
                                <b class = "caret"></b>
                             </a>

                             
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/visitor')}}">Visitors</a></li>
                                <li><a href="{{url('/student')}}">Students</a></li>
                                <li><a href="#">Faculty</a></li>
                                <li><a href="#{{url('/admission')}}">Admissions</a></li>
                                <li><a href="{{url('/department')}}">Department</a></li>
                                <li><a href="{{url('/program')}}">Programs</a></li>
                               
                            </ul>
                             

                          </li>
                          <!--
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
                            -->

                       </ul>
                    </div>

                 </nav>
                     
                
                    <ul class = "nav  navbar-default pull-right" role = "navigation">
                        @if (Auth::guest())
                        <li class = "dropdown">
                             <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" style="color:white;">
                                My Account
                                <b class = "caret"></b>
                             </a>

                             <ul class = "dropdown-menu">
                                <li><a href="{{ url('/login') }}"> Login</a></li>
                                
                                <li class = "divider"></li>
                                
                                <li><a href="{{ url('/register') }}" > Register</a></li>
                             </ul>

                          </li>
                          @else
                          <li class = "dropdown">
                              <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" style="color:white;">
                                {{ Auth::user()->name }}
                                <b class = "caret"></b>
                             </a>

                             <ul class = "dropdown-menu">
                                <li><a href = "#">My Profile</a></li>
                                
                                <li class = "divider"></li>
                                <li><a href="{{ url('/logout') }}" >Logout</a></li>
                             </ul>

                          </li>
                          @endif
                    </ul>
                    
                    
                </div>
            </div>
        <br>
            @if (session('flash_message'))
                <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('flash_message') }}
                </div>
            @endif
               
            @yield('content')
            </div>
   

    <!-- JavaScripts -->
    
    
    
</body>
</html>