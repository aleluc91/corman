@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 offset-md-2 offset-lg-2">
            <h4>Users founded</h4>
            @if($users->isNotEmpty())
                @if(count($users) > 3)
                    @for($i=0 ; $i <= 2 ; $i++)
                        @include('users.includes.user_card_search' , ['user' => $users[$i]])
                    @endfor
                @else
                    @for($i=0 ; $i <= count($users) - 1 ; $i++)
                        @include('users.includes.user_card_search' , ['user' => $users[$i]])
                    @endfor
                @endif
                @if(count($users) > 3)
                    <a class="btn btn-info btn-block" href="{{ route('search.index.users' , ['value' => $value]) }}">Show more</a>
                @endif
            @else
                <div class="card bg-white mb-3">
                    <div class="card-body">
                        <h4 class="text-center">No user was found.</h4>
                    </div>
                </div>
            @endif
            <h4>Publications founded</h4>
            @if($publications->isNotEmpty())
                @if(count($publications) > 3)
                    @for($i=0 ; $i <= 2 ; $i++)
                        @include('publications.includes.publication_card_search' , ['publication' => $publications[$i] , 'topics' => $topics[$i]])
                    @endfor
                @else
                    @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                        @include('publications.includes.publication_card_search' , ['publication' => $publications[$i] , 'topics' => $topics[$i]])
                    @endfor
                @endif
                @if(count($publications) > 3)
                    <a class="btn btn-info btn-block" href="{{ route('search.index.publications' , ['value' => $value]) }}">Show more</a>
                @endif
            @else
                <div class="card bg-white">
                    <div class="card-body">
                        <h4 class="text-center">No publication was found.</h4>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
