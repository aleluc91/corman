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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<header class="top-header shadow-sm">
    <div class="d-flex h-100 align-items-center">
        <h1 class="text-center main-text w-100">Corman</h1>
    </div>
</header>

<div class="main-content">
    <main class="h-90">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-6">
                    <h1 class="text-center main-textt">Welcome, join our community!</h1>
                    <p class="lead text-center text-dark">Corman is a platform well suited for researchers. It allows you to share
                        your papers
                        (every kind of!) with other reasearcher, it makes easier to find and preserve all your papers and
                        supports the creation of collaborative groups to increase productivity.</p>
                </div>
                <div class="col-md-6 ">
                    <div class="card bg-white shadow rounded">
                        <div class="card-header">
                            <h2 class="text-center" style="color: #000000">Login</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf

                                <div class="form-group mx-1">
                                    <label for="email"><b>{{ __('Email') }}</b></label>
                                    <input id="name" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                                           value="{{ old('email') }}"
                                           placeholder="you@example.com" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mx-1">
                                    <label for="password"><b>{{ __('Password') }}</b></label>
                                    <input id="name" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                                           placeholder="********">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="d-flex flex-column">
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block float-right">Login</button>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-center">Don't have an account yet? Please <a href="{{ route('register') }}">Sign up!</a>
                                            it's free.</p>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-center"><a class="btn btn-link" href="{{ route('password.request') }}">Forgot password?</a></p>
                                    </div>
                                </div>


                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark h-10">
        <h1 class="text-center">Footer</h1>
    </footer>
</div>


</body>
</html>

