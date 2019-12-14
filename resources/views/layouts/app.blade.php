<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">


        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
            @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                  </li>
              @endif
              @else
                <li class="nav-item">
                  <a class="nav-link" href="/examinations">Badania</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/doctors">Lekarze</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/referals">Skierowania</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/prescriptions">Recepty</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/recommendations">Zalecenia</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/fullcalendar">Terminarz</a>
                </li>
              <li class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown10">
                  <a class="dropdown-item" href="{{url('/dashboard')}}">Wybierz podopiecznego</a>
                  <a class="dropdown-item" href="#">Edytuj dane podopiecznego</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Wyloguj') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            @endguest

          </ul>
        </div>
      </nav>
      <div class="container">
        @include('inc.messages')
        @yield('content')
      </div>
      @yield('script')
<!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
-->
  </body>
</html>
