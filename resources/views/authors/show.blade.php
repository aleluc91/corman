@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                @include('users.includes.user_card' , ['user' => $user])
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                @if($publications->isNotEmpty())
                @if(($user->privacy === 'private') and ($user->id !== Auth::user()->id))
                    <h4 class="">You can only see a few of the last publications for this user.</h4>
                    @if(count($publications) > 5)
                        @for($i=0 ; $i <= 4 ; $i++)
                            @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                        @endfor
                    @else
                        @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                            @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                        @endfor
                    @endif

                @else
                    {{--@include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])--}}
                    @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                        @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                    @endfor

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            {{$publications->links()}}
                        </div>
                    </div>
                @endif
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="card bg-white">
                                <div class="card-body">
                                    <h4 class="text-center">No publications were found for this user.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                <h3>User groups</h3>
                @if(Auth::user()->id === $user->id)
                    <a href="{{ route('groups.create') }}" class="btn btn-info  my-2">Create new group<i
                                class="fas fa-plus ml-2"></i></a>
                @endif
                @if(($user->privacy === 'private') and ($user->id !== Auth::user()->id))
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5 class="text-center text-danger">This profile is private.</h5>
                            <p class="small text-center">You can not see other information.</p>
                        </div>
                    </div>
                @else
                    @if($groups->isNotEmpty())
                        @include('groups.includes.group_card' , ['groups' => $groups])
                    @else
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4>This user don't belong to any group.</h4>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>

    </div>

@endsection