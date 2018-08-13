@extends('layouts.app')

@section('content')

    <div class="container my-2">
        <div class="row">
            <div class="col-md-4">
                @include('users.includes.user_info')

            </div>
            <div class="col-md-8">
                <form>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" value=" {{ Auth::user()->name }}"
                                   autofocus>
                        </div>
                        <div class="col-6 form-group">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control form-control-lg" id="lastName" value="{{ Auth::user()->last_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" value=" {{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="dateOfBirth">Date of birth</label>
                        <input type="date" class="form-control form-control-lg" id="dateOfBirth"
                               value="{{Auth::user()->date_of_birth}}">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control form-control-lg">
                            <option>Select your country...</option>
                        </select>
                    </div>
                    <div class="form-group">

                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection