@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-7 col-lg-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-info" href="{{ route('groups.show' , $groupId) }}">Back to group page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage users</li>
                    </ol>
                </nav>
                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    <ul>
                    @for($i = 0 ; $i <= count($users) - 1 ; $i++)
                        @include('groups.includes.manage_user_card' , ['user' => $users[$i] , 'userRole' => $usersRole[$i] , 'groupId' => $groupId])
                    @endfor
                    </ul>
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