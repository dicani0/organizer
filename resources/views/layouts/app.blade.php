<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <script src="{{ asset('js/popper.min.js')}}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/pl.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fa/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <link href="{{ asset('css/popup.css') }}" rel="stylesheet">
    <script src="{{ asset('js/popup.js')}}"></script>


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
                  <a class="nav-link
                  @if (strpos(Request::url(), 'examination') == true)
                    {{'active'}}
                  @endif
                  " href="/examinations">Badania</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link
                  @if (strpos(Request::url(), 'doctor') == true)
                    {{'active'}}
                  @endif
                  " href="/doctors">Lekarze</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link
                  @if (strpos(Request::url(), 'referal') == true)
                    {{'active'}}
                  @endif
                  " href="/referals">Skierowania</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link
                  @if (strpos(Request::url(), 'prescription') == true)
                    {{'active'}}
                  @endif
                  " href="/prescriptions">Recepty</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link
                  @if (strpos(Request::url(), 'recommendation') == true)
                    {{'active'}}
                  @endif
                  " href="/recommendations">Zalecenia</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link
                  @if (strpos(Request::url(), 'event') == true)
                    {{'active'}}
                  @endif
                  " href="/events">Terminarz</a>
                </li>
              <li class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown1">
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
              @if (session()->get('subuser_id')!=null)
                <li class="nav-item float-right">
                  <a href="/dashboard" class="btn btn-outline-dark">Wybrany podopieczny {{session()->get('subuser_fullname')}}</a>

                </li>

              @endif
            @endguest

          </ul>
        </div>
      </nav>
      <div class="container">
        @include('inc.messages')
        @yield('content')
      </div>
      @yield('script')
      <script type="text/javascript">
        $(document).ready()
        {
          $.ajax(
            {
              method: 'GET',
              url: '/checkevents',
              success: function(response)
              {
                if(response != "")
                {
                $('#alert-box').html(
                  '<div style="line-height: 34px;" class="alert alert-warning" role="alert">'+ response + '<a class="text-center btn btn-primary float-right confirmEvent" href="/events">Terminarz</a>' + '</div>');
                }
              }
            }
          )
        }

        $(document).on('click', '.confirmEvent' , function(e){
          var now = new Date();
          var expire = new Date();
          var expires = "expires="+expire.toString();
          expire.setFullYear(now.getFullYear());
          expire.setMonth(now.getMonth());
          expire.setDate(now.getDate()+1);
          expire.setHours(0);
          expire.setMinutes(0);
          expire.setSeconds(0);
          document.cookie = "display=yes; "+expires;
        })
      </script>
<!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
-->
  </body>
</html>
