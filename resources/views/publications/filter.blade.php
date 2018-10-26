@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                @include('users.includes.user_card' , ['user' => Auth::user()])
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">

               {{-- <div class="row justify-content-md-end justify-content-lg-end">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        @include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])
                    </div>
                </div>--}}

                <a href="{{ route('publications.create') }}" class="btn btn-light  my-2">Create new publication<i
                            class="fas fa-plus ml-2"></i></a>
                @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                    @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                @endfor

                <div class="row justify-content-center">
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                        {{$publications->links()}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                <h3>Your groups</h3>
                <a href="{{ route('groups.create') }}" class="btn btn-light  my-2">Create new group<i
                            class="fas fa-plus ml-2"></i></a>
                @if($groups->isNotEmpty())
                    @include('groups.includes.group_card' , ['groups' => $groups])
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4>You don't belong to any group.</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



@endsection