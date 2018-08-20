
    <nav class="navbar fixed-top navbar-laravel navbar-expand-md navbar-light shadow">
        <div class="container">
            @guest
            <a class="navbar-brand text-white" style="text-transform: uppercase ; font-weight: 700;" href="{{ url('/home') }}">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
            </a>
            @else
                <a class="navbar-brand text-white" style="text-transform: uppercase ; font-weight: 700;" href="{{ url('/home') }}">
                    <h1>{{ config('app.name', 'Laravel') }}</h1>
                </a>
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <form class="form-inline">
                                <button class="btn btn-light btn-lg m-2" style="text-transform: uppercase;">
                                    Login
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item text-dark dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}  {{Auth::user()->last_name}}<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('users.index') }}" class="dropdown-item">Profile</a>
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
