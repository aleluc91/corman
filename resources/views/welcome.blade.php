<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>
<body>
<header class="top-header h-10 shadow rounded">
    <div class="d-flex h-100 align-items-center">
        <h1 class="text-center header-text w-100">Corman</h1>
    </div>
</header>

<main class="h-80">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-6">
                <h1 class="text-center text-primary">Welcome! Join our community</h1>
                <p class="lead text-center">Corman is a platform well suited for researchers. It allows you to share
                    your papers
                    (every kind of!) with other reasearcher, it makes easier to find and preserve all your papers and
                    supports the creation of collaborative groups to increase productivity.</p>
            </div>
            <div class="col-md-6 ">
                <div class="card shadow bg-white rounded">
                    <div class="card-header bg-white">
                        <h2 class="text-center" style="color: #000000">Login</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group mx-1">
                                <label for="email"><b>{{ __('Email') }}</b></label>
                                <input id="name" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com" required autofocus>
                            </div>

                            <div class="form-group mx-1">
                                <label for="password"><b>{{ __('Password') }}</b></label>
                                <input id="name" type="password" class="form-control" name="password"
                                       placeholder="********"
                                       required>
                            </div>

                            <div class="d-flex flex-column">
                                <div class="mt-2">
                                    <button class="btn btn-primary btn-lg btn-block  float-right">Login</button>
                                </div>
                                <div class="mt-3">
                                    <p class="text-center">Don't have an account yet? Please <a href="{{ route('register') }}">Sign up!</a>
                                        it's free.</p>
                                </div>
                                <div class="mt-1">
                                    <p class="text-center"><a href="#">Forgot password?</a></p>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="h-10">
    <h1 class="h-100">Footer</h1>
</footer>

</body>
</html>

