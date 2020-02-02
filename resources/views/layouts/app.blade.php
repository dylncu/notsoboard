<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NotSoBoard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('/storage/css/styles.min.css')}}">
    <link rel="stylesheet" href="{{asset('/storage/css/app.css')}}">

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean">
        <div class="container"><a class="navbar-brand"><img src="{{asset('/storage/images/nsblogo.png')}}" style="height: 83px;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                            <a class="nav-link" href="{{ url('/games/add') }}">Add Game</a>
                    </li>
                    <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                @endauth
                    <li class="nav-item" role="presentation"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="/games">Games</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="/reviews">Reviews</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="/about">About</a></li>
                </ul>
        </div>
        </div>
    </nav>
    



<div style="min-height: 65vh">
@yield('content')
</div>

<div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 item text">
                    <p>Not So Board © 2020</p>
                    <p>We provide bite-sized reviews for current and future board game hobbiests.</p>
                    </div>
                    <div class="col item social"><a href="https://twitter.com/NotSoBoardGames"><i class="icon ion-social-twitter"></i></a></a><a href="https://www.instagram.com/notsoboardgames/"><i class="icon ion-social-instagram"></i></a></div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

