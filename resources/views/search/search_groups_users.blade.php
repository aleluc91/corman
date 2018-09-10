@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-info" href="{{ route('groups.show' , $groupId) }}">Back to group page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add users to group</li>
                    </ol>
                </nav>
                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    @for($i = 0 ; $i <= count($users) - 1 ; $i++)
                        <div class="card bg-white my-3 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 ">
                                        <div class="profile-card">
                                            <img class="avatar" src="{{ asset('storage/' . $users[$i]->avatar) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class=" my-3">{{ $users[$i]->name }} {{ $users[$i]->last_name }}</h4>
                                        <h6>
                                            <span class="mr-1"><i class="fas fa-university text-danger"></i></span>
                                            <span class="font-weight-bold">Affiliation :</span>
                                            <span class="text-muted">{{ $users[$i]->affiliation }}</span>
                                        </h6>
                                        <h6>
                                            <span class="mr-1"><i class="fas fa-book text-danger"></i></span>
                                            <span class="font-weight-bold">Lines of research :</span>
                                            <span class="text-muted">{{ $users[$i]->lines_of_research }}</span>
                                        </h6>
                                    </div>
                                </div>

                                <form class="float-right" method="post" action="{{ route('groups.registration.notification.store') }}">
                                    @csrf
                                    <input type="hidden" name="groupId" value="{{ $groupId }}">
                                    <input type="hidden" name="userId" value="{{ $users[$i]->id }}">
                                    <input type="hidden" name="byUserId" value="{{ Auth::user()->id }}">
                                    @if($pendings[$i] === false)
                                        <button class="btn btn-info" type="submit"><i class="fas fa-plus"></i></button>
                                    @else
                                        <button class="btn btn-info" type="submit" disabled>Pending request</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    @endfor
                @else
                    <div class="card bg-white mb-3">
                        <div class="card-body">
                            <h4 class="text-center">No user was found.</h4>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection