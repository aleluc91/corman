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

<main class="h-100">
    <div class="container h-100 mt-2">
        <div class="d-flex flex-column align-items-center">
            <div><h1 class="main-text">Corman</h1></div>
            <div><h4 class="main-text">Join our community is free!</h4></div>
            <div class="card shadow mt-2">

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"><b>{{ __('Name') }}</b></label>
                                <input id="name" type="text"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Your name" autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastName"><b>{{ __('Surname') }}</b></label>
                                <input id="lastName" type="text" class="form-control {{ $errors->has('lastName') ? 'is-invalid' : '' }}" name="lastName"
                                       value="{{ old('lastName') }}"
                                       placeholder="Your last name">
                                @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email"><b>{{ __('Email') }}</b></label>
                            <input id="name" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="you@example.com">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password"><b>{{ __('Password') }}</b></label>
                                <input id="name" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"
                                       placeholder="********">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="confirmPassword"><b>{{ __('Confirm Password') }}</b></label>
                                <input id="passwordConfirm" type="password" class="form-control" name="password_confirmation"
                                       placeholder="********">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="affiliation"><b>{{ __('Affiliation') }}</b></label>
                            <input id="affiliation" type="text" class="form-control {{ $errors->has('affiliation') ? 'is-invalid' : '' }}" name="affiliation"
                                   placeholder="Massachusetts Institute of Technology">
                            @if ($errors->has('affiliation'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="linesOfResearch"><b>{{ __('Lines of research') }}</b></label>
                            <input id="linesOfResearch" type="text" class="form-control {{ $errors->has('linesOfResearch') ? 'is-invalid' : '' }}" name="linesOfResearch"
                                   placeholder="">
                            @if ($errors->has('linesOfResearch'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linesOfResearch') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary m-2 float-right">Registrati</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

</body>
</html>

