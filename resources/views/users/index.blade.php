@extends('layouts.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/tagInput.css') }}">
    @endpush

    @push('scripts')
        <script src=" {{ asset('js/tagInput.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('#tags').tagInput({labelClass:"badge badge-success"});
            });
        </script>
    @endpush

    <div class="container my-2">
        <div class="row user-profile">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header bg-white">

                        <img class="rounded-circle avatar text-center" src="{{ asset('storage/avatar.jpg') }}"
                             alt="user avatar">
                        <h3 class="text-center">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3>

                    </div>
                    <div class="card-body bg-white">
                        <ul>
                            <li><i class="far fa-envelope"></i> <span
                                        class="text-muted ml-2">Email : </span>{{Auth::user()->email}}</li>
                            <li><i class="fas fa-calendar-alt"></i> <span
                                        class="text-muted ml-2">Date of birth : </span> {{Auth::user()->date_of_birth}}</li>
                            <li><i class="far fas fa-map-marker-alt"></i> <span
                                        class="text-muted ml-2">Country : </span> {{Auth::user()->country}}</li>
                            <li><i class="far fa-envelope"></i> <span
                                        class="text-muted ml-2">Gender : </span> {{Auth::user()->gender}}</li>
                            <li><i class="far fa-envelope"></i> <span
                                        class="text-muted ml-2">Affiliation : </span> {{Auth::user()->affiliation}}</li>
                            <li><i class="far fa-envelope"></i> <span
                                        class="text-muted ml-2">Lines of research : </span> {{Auth::user()->lines_of_research}}
                            </li>
                        </ul>
                    </div>
                </div>
                {{--<img class="avatar" src="{{ asset('storage/avatar.jpg') }}" alt="user avatar">--}}
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header bg-white">
                        Cambia immagine
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update' , Auth::user()->id) }}" >
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">

                            <div class="row">
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label class="text-muted" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value=" {{ Auth::user()->name }}"
                                           autofocus>
                                </div>
                                <div class="col-md-6 col-sm-12 form-group">
                                    <label class="text-muted" for="lastName">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                           value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value=" {{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="dateOfBirth">Date of birth</label>
                                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"
                                       value="{{Auth::user()->date_of_birth}}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="country">Country</label>
                                <select id="country" class="form-control" name="country">
                                    <option>Select your country...</option>
                                    <option>Italy</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="gender">Gender</label>
                                <select id="gender" class="form-control" name="gender">
                                    <option>Select your gender...</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="dateOfBirth">Affiliation</label>
                                <input type="text" class="form-control" id="affiliation" name="affiliation"
                                       value="{{Auth::user()->affiliation}}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="linesOfResearchBox">Lines of Research</label>
                                <div class="form-control tags" id="tags">
                                    <input id="linesOfResearchBox" type="text" class="labelinput">
                                    <input type="hidden" id="linesOfResearch" value="{{ Auth::user()->lines_of_research }}" name="linesOfResearch">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>

                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-4 user-profile-data shadow">
                <h3 class="">{{ Auth::user()->name}} {{Auth::user()->last_name}}</h3>

            </div>--}}
        </div>
    </div>


@endsection