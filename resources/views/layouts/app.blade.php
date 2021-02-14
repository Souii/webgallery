<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 mt-0">
            <div class="container">
                <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">

                  <ul class="navbar-nav ml-auto">
                      @guest
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                      @else
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li>
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                              </li>
                            </ul>
                          </li>
                      @endguest
                  </ul>
                </div>

            </div>
        </nav>

        <div class="container-fluid">
            {{ $slot }}
        </div>


        <script type="text/javascript">
            function logout() {
                document.getElementById('logoutForm').submit();
            }
        </script>
    </body>
</html>
