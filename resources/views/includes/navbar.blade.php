
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
                    <li class="nav-item">
                        <a class="nav-link h5" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" id="search" type="text" placeholder="Search" autocomplete="off">
                    <button id="btnSearch" class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>



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

                        {{--<li class="nav-item">
                           <img class="rounded-circle" src="{{ asset('storage/' . Auth::user()->avatar) }}" style="height:50px; width:50px;">
                        </li>--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle h5" href="#" role="button"
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



    @push('body.scripts')
        <script src="{{ asset('vendor/typeahead/js/typeahead.bundle.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var topicsEngine = new Bloodhound({
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: 'http://localhost/corman/public/search/autocomplete/topics/%QUERY%',
                        wildcard: '%QUERY%'
                    }
                });

                $('#search').typeahead(
                    {
                        minLength: 2,
                        highlight: true
                    },
                    {
                        name: 'topics',
                        source: topicsEngine,
                        displayKey: 'name'
                    }
                );

                $('#btnSearch').on('click', function(e){
                    e.preventDefault();
                    if($('#search').val())
                        window.location.href = "http://localhost/corman/public/search/" + $('#search').val() + '/index' ;
                })

            });
        </script>
    @endpush
