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

<main class="h-90 mt-2">
    <div class="container h-100">
        <div class="d-flex flex-column align-items-center">
            <div><h1>Corman</h1></div>
            <div><h3>Join our community is free!</h3></div>
            <div class="card border-0">

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"><b>{{ __('Name') }}</b></label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       placeholder="Your name" required autofocus>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="surname"><b>{{ __('Surname') }}</b></label>
                                <input id="surnname" type="text" class="form-control" name="surname"
                                       value="{{ old('surname') }}"
                                       placeholder="Your name" required>
                            </div>
                        </div>


                        <div class="form-group row mx-1">
                            <label for="email"><b>{{ __('Email') }}</b></label>
                            <input id="name" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="you@example.com" required>
                        </div>

                        <div class="form-group row mx-1">
                            <label for="password"><b>{{ __('Password') }}</b></label>
                            <input id="name" type="password" class="form-control" name="password"
                                   placeholder="********"
                                   required autofocus>
                        </div>

                        <div class="form-group row m-2">
                            <label for="confirmPassword"><b>{{ __('Confirm Password') }}</b></label>
                            <input id="confirmPassword" type="password" class="form-control" name="confirmPassword"
                                   placeholder="********"
                                   required>
                        </div>

                        <div class="form-group row m-2">
                            <label for="affiliation"><b>{{ __('Affiliation') }}</b></label>
                            <input id="affiliation" type="password" class="form-control" name="affiliation"
                                   placeholder="Massachusetts Institute of Technology"
                                   required>
                        </div>

                        <div class="form-group row m-2">
                            <label for="linesOfResearch"><b>{{ __('Lines of research') }}</b></label>
                            <input id="linesOfResearch" type="password" class="form-control" name="linesOfResearch"
                                   placeholder=""
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary m-2 float-right">Registrati</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<footer class="h-10 bg-dark">

</footer>

</body>
</html>

