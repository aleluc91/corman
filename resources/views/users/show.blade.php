@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card bg-white">
                <div class="card-header bg-white">
                    <h2 class="text-center">Current profile data</h2>
                </div>
                <div class="card-body">
                    <div class="profile-card mb-3">
                        <img class="avatar1" src="{{ asset('storage/' . $user->avatar) }}">
                    </div>
                    <h1 class="text-center text-info mb-3">{{ $user->name }} {{ $user->last_name }}</h1>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card bg-white">
                                <div class="card-body">
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-envelope text-danger"></i></span>
                                        <span class="font-weight-bold">Email :</span>
                                        <span class="text-muted"> {{ $user->email }} </span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-calendar text-danger"></i></span>
                                        <span class="font-weight-bold">Date of birth :</span>
                                        <span class="text-muted">{{ date('d/m/Y', strtotime($user->date_of_birth)) }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                        <span class="font-weight-bold">Country :</span>
                                        <span class="text-muted">{{ $user->country }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-venus-mars text-danger"></i></span>
                                        <span class="font-weight-bold">Gender :</span>
                                        <span class="text-muted">{{ $user->gender }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-university text-danger"></i></span>
                                        <span class="font-weight-bold">Affiliation :</span>
                                        <span class="text-muted">{{ $user->affiliation }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-book text-danger"></i></span>
                                        <span class="font-weight-bold">Lines of research :</span>
                                        <span class="text-muted">{{ $user->lines_of_research }}</span>
                                    </h6>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card bg-info mb-2">
                                <div class="card-body">
                                    <h4 class="text-center text-white">Total publications</h4>
                                    <h4 class="text-center text-white">{{ $user->author->publications->count() }}</h4>
                                </div>
                            </div>
                            <div class="card bg-info my-2">
                                <div class="card-body">
                                    <h4 class="text-center text-white">Total groups</h4>
                                    <h4 class="text-center text-white">{{ $user->groups->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->id === $user->id)
                <a href="{{ route('users.edit' , ['id' => Auth::user()->id]) }}" class="btn btn-info float-right mt-2">Edit profile</a>
            @endif
        </div>
    </div>
</div>
@endsection