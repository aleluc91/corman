@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    @foreach($users as $user)
                        @include('publications.includes.users_card_search' , ['users' => $users])
                    @endforeach
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