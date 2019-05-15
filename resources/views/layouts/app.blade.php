<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom script Scripts  
    <script  type="text/javascript" src="{{ asset('public/js/jquery-2.2.4.min.js') }}" ></script>
   
    <script  type="text/javascript" src="{{ asset('public/js/app.js') }}"></script> -->
    <script  type="text/javascript" src="{{ asset('public/js/global.js') }}" ></script>
   

    <!-- Custom Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
       
    <!-- datatables assets  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/datatables.min.css"/>    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/datatables.min.js"></script>
    
    <!-- Fonts  -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}" >       
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('mail.host', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>                    
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ request()->is('sbc/list') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('sbc.list') }}">Blast</a>
                        </li>

                        <li class="nav-item  {{ request()->is('import') ? 'active' : '' }}">
                          
                        </li>                       

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('tp*') ? 'active' : '' }} " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Template
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{ route('tp.index') }}">Create</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('tp.show') }}">List</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('c*') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{ route('c.index') }}">Create</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('c.show') }}">List</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  {{ request()->is('b*') ? 'active' : request()->is('import') ? 'active' : ''  }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Batches
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                            
                            <a class="dropdown-item" href="{{ route('b.index') }}">Create</a>
                            <a class="dropdown-item" href="{{ route('import') }}">Import CSV</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('b.show') }}">List</a>                           
                            </div>
                        </li>
                       
                    </ul>
                    
                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ml-auto">
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Login') }}</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="">{{ __('Register') }}</a>
                        </li>                            
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Template') }}<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href=""
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                        -->
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">      
            @yield('content')
        </main>
    </div>
</body>
<footer class="footer-copyright text-center py-3">
    <a>  c</a>
</footer>
</html>
@yield('script')