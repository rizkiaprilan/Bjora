<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="container app">
    <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm ">
        <div class="container">

            <ul style="list-style:  none">
                <li class="nav-item">
                    <a class="navbar-brand" href="/question">
                        <span class="bjora">Bjora</span>
                    </a>

                </li>

                <li class="nav-item"><label id="timer" class="mr-auto text-white"></label></li>
            </ul>


            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon "></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest

                    @elseif(Auth::user()->role == 'member')
                        <li class="nav-item">
                            <a href="question/{{Auth::user()->id}} " class="nav-link">
                                <span class="text-white">My Question</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <span class="text-white">Inbox</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role == 'admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-white">Manage</span> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">User</a>
                                <a class="dropdown-item" href="#">Question</a>
                                <a class="dropdown-item" href="#">Topic</a>


                            </div>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><span
                                    class="text-white">{{ __('Login') }}</span></a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><span
                                        class="text-white">{{ __('Register') }}</span></a>
                            </li>
                        @endif
                    @else
                        @if(!Auth::user() or Auth::user()->role == 'member')
                            <li class="nav-item">
                                <a href="{{route('question.create')}}" class="nav-link">
                                    <button class="btn btn-danger">
                                        <span class="text-white">Add Question</span>
                                    </button>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-white">{{ Auth::user()->name }}</span> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">{{ __('Profile') }}</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4" id="body">
        @yield('content')
    </main>

    <footer class="card-footer bg-dark" id="footer">
        <div class="text-center ">

            <span class="text-white"> &copy; 2019 Copyright</span> <span class="bjora">Bjora.com</span>
        </div>
    </footer>
</div>
</body>
</html>
