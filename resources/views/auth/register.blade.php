@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/selectize.js/css/selectize.default.css')}}"/>
@endpush

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow mt-2">
                    <div class="card-header bg-white">
                        <h1 class="text-center">Welcome to <span class="text-info">Corman</span></h1>
                        <h4 class="text-center">Join our community it's free!</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name"><b>{{ __('Name') }}</b></label>
                                    <input id="name" type="text"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           name="name"
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
                                    <input id="lastName" type="text"
                                           class="form-control {{ $errors->has('lastName') ? 'is-invalid' : '' }}"
                                           name="lastName"
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
                                <input id="name" type="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
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
                                    <input id="password" type="password"
                                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                           name="password"
                                           placeholder="********">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="confirmPassword"><b>{{ __('Confirm Password') }}</b></label>
                                    <input id="passwordConfirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           placeholder="********">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="affiliation"><b>{{ __('Affiliation') }}</b></label>
                                <input id="affiliation" type="text"
                                       class="form-control {{ $errors->has('affiliation') ? 'is-invalid' : '' }}"
                                       name="affiliation"
                                       placeholder="Massachusetts Institute of Technology">
                                @if ($errors->has('affiliation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="linesOfResearch"><b>{{ __('Lines of research') }}</b></label>
                                <input id="linesOfResearch" type="text"
                                       class="{{ $errors->has('linesOfResearch') ? 'is-invalid' : '' }}"
                                       name="linesOfResearch">
                                @if ($errors->has('linesOfResearch'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linesOfResearch') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary m-2 float-right">Register</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('body.scripts')
    <script type="text/javascript" src="{{asset('vendor/selectize.js/js/standalone/selectize.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#linesOfResearch').selectize({
                plugins: ['remove_button'],
                maxItems: 5,
                delimiter: ',',
                highlight: true,
                dropdownParent: 'body',
                create: function (input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

        });
    </script>

@endpush

