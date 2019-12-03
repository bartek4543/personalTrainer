<html>
    <head>
        <title>Trenowanie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='/js/script.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/css/style.css">
        
    </head>
    <body>
        <nav class="navbar navbar-expand-sm sticky-top">

  
            <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
             <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link " href="{{route('home')}}">STRONA GŁÓWNA</a></li>
                @if(session('user_id') != null)
                    @if(session('status') == 'Podopieczny')
                    <li class="nav-item"><a class="nav-link " href="{{route('trainerList')}}">TRENERZY</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('daySchedule')}}">PLANY DNI</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link " href="{{route('proteges')}}">TWOI PODOPIECZNI</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('yourDishes')}}">TWOJE DANIA</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('yourExercises')}}">TWOJE ĆWICZENIA</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link " href="{{route('showProgress')}}">POSTĘPY</a></li>
                    
                @endif
            </ul>
                 <ul class="navbar-nav ml-auto">
                 @if(session('user_id') == null)
                    <li class="nav-item"><a class="nav-link" href="{{ route('loginPage') }}">LOGOWANIE</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('registerPage') }}">REJESTRACJA</a></li>
                @else
                    <li class="nav-item"><a class="nav-link " href="{{ route('messages') }}">WIADOMOŚCI</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{ route('profile') }}">PROFIL</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }} ">WYLOGUJ</a></li>
                @endif
            </ul>
             </div>
        </nav>
        <div id='main' class="justify-center">
        @section('main')
        @show
        </div>
        
    </body>
</html>

