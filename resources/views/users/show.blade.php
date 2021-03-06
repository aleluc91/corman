@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                        <div class="profile-card mb-3">
                                <img class="avatar1" src="{{ asset('storage/' . $user->avatar) }}">
                            </div>
                            <h1 class="text-center text-dark mb-3">{{ $user->name }} {{ $user->last_name }}</h1>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card bg-white">
                                <div class="card-body">
                                    @if($user->privacy === 'public' or Auth::user()->id === $user->id)
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-envelope text-dark"></i></span>
                                        <span class="font-weight-bold">Email :</span>
                                        <span class="text-muted"> {{ $user->email }} </span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-calendar text-dark"></i></span>
                                        <span class="font-weight-bold">Date of birth :</span>
                                        <span class="text-muted">{{ date('d/m/Y', strtotime($user->date_of_birth)) }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-map-marker-alt text-dark"></i></span>
                                        <span class="font-weight-bold">Country :</span>
                                        <span class="text-muted">{{ $user->country }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-venus-mars text-dark"></i></span>
                                        <span class="font-weight-bold">Gender :</span>
                                        <span class="text-muted">{{ $user->gender }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-university text-dark"></i></span>
                                        <span class="font-weight-bold">Affiliation :</span>
                                        <span class="text-muted">{{ $user->affiliation }}</span>
                                    </h6>
                                    <h6>
                                        <span class="mr-1"><i class="fas fa-book text-dark"></i></span>
                                        <span class="font-weight-bold">Lines of research :</span>
                                        <span class="text-muted">{{ $user->lines_of_research }}</span>
                                    </h6>
                                    @else
                                        <h5 class="text-center text-danger">This profile is private</h5>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card bg-primary mb-2">
                                <div class="card-body">
                                    <h4 class="text-center text-white">Total publications</h4>
                                    <h4 class="text-center text-white">
                                        {{ $user->author->publications->count() }}
                                    </h4>
                                </div>
                            </div>
                            <div class="card bg-primary my-2">
                                <div class="card-body">
                                    <h4 class="text-center text-white">Total groups</h4>
                                    <h4 class="text-center text-white">{{ $user->groups->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end mt-2">
                <div class="col-auto">
                    @if(Auth::user()->id === $user->id)
                        <a href="{{ route('users.edit' , ['id' => Auth::user()->id]) }}" class="btn btn-primary">Edit profile</a>
                    @endif
                    <a class="btn btn-info"
                       href="{{ route('authors.show' , $user->author->id) }}">
                        <i class="far fa-eye mr-2"></i>
                        View Publication
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection