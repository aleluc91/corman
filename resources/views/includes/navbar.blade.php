<nav class="navbar fixed-top navbar-laravel navbar-expand-md navbar-light shadow">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand text-white" style="text-transform: uppercase ; font-weight: 700;"
               href="{{ route('welcome') }}">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
            </a>
        @else
            <a class="navbar-brand text-white" style="text-transform: uppercase ; font-weight: 700;"
               href="{{ url('/home') }}">
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

            @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link h5" href="{{ route('home') }}">Home<span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link h5" href="{{ route('groups.index') }}">Groups<span
                                    class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" id="search" type="text" placeholder="Search" autocomplete="off">
                    <button id="btnSearch" class="btn btn-outline-light my-2 my-sm-0" type="submit"><i
                                class="fas fa-search"></i></button>
                </form>
        @endauth


        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <form class="form-inline">
                            <a href="{{ route('login') }}" class="btn btn-outline-light m-2"
                               style="text-transform: uppercase;">
                                Login<i class="fas fa-sign-in-alt ml-2"></i>
                            </a>
                        </form>
                    </li>
                @else

                    {{--<li class="nav-item">
                       <img class="rounded-circle" src="{{ asset('storage/' . Auth::user()->avatar) }}" style="height:50px; width:50px;">
                    </li>--}}
                    <li class="nav-item mr-2">
                        <button class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#notificationModal">
                            <div class="fa-2x">
                                <span class="fa-layers fa-fw">
                                <i class="fas fa-bell"></i>
                                    @if($registrationNotifications->isNotEmpty())
                                        <span class="fa-layers-counter"
                                              style="background:Tomato">{{ $registrationNotifications->count() }}</span>
                                    @endif
                            </span>
                            </div>
                        </button>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle h5" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}  {{Auth::user()->last_name}}<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('users.show' , ['id' => Auth::user()->id]) }}" class="dropdown-item">Profile</a>
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

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($registrationNotifications->isNotEmpty())
                    @for($i = 0 ; $i <= count($registrationNotifications) - 1; $i++)
                        @include('notifications.includes.registration_notifications_card' , [
                            'registrationNotification' => $registrationNotifications[$i],
                            'groupPending' => $groupsPending[$i],
                            'userBy' => $usersBy[$i]
                        ])
                    @endfor
                @else
                    <div class="card-bg-white">
                        <div class="card-body">
                            <h3>You have no notifications</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@push('body.scripts')
    <script src="{{ asset('vendor/typeahead/js/typeahead.bundle.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var topicsEngine = new Bloodhound({
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/search/autocomplete/topics/%QUERY%',
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

            $('#btnSearch').on('click', function (e) {
                e.preventDefault();
                if ($('#search').val())
                    window.location.href = "/search/" + $('#search').val();
            })

            var userEngine = new Bloodhound({
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/search/autocomplete/users/%QUERY%',
                    wildcard: '%QUERY%'
                }
            });

            $('#searchUser').typeahead(
                {
                    minLength: 2,
                    highlight: true
                },
                {
                    name: 'users',
                    source: userEngine,
                    displayKey: function (user) {
                        return user.name + ' ' + user.last_name;
                    }
                }
            );

            $('#btnSearchUser').on('click', function (e) {
                e.preventDefault();
                if ($('#searchUser').val() && $('#groupId').val())
                    window.location.href = "/search/groups/users/" + $('#searchUser').val() + "/" + $('#groupId').val();

            })


        });
    </script>
@endpush




