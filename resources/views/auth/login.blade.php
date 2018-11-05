@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow mt-3">
                    <div class="card-header bg-white">
                        <h1 class="text-center">Welcome back to <span class="text-primary">Corman</span>.</h1>
                        <h4 class="text-center">Please log in. </h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>

                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password"
                                       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn-link text-info" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn-link text-info" href="{{ route('register') }}">
                                        Don't have an account yet? Sign up!
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-0 justify-content-end">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}<i class="fas fa-sign-in-alt ml-2"></i>
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
