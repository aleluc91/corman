@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                @include('users.includes.user_card' , ['user' => Auth::user()])
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                <div class="row justify-content-md-end justify-content-lg-end">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        @include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])
                    </div>
                </div>

                <a href="{{ route('publications.create') }}" class="btn btn-primary my-2"><i class="fas fa-plus mr-2"></i>Create new publication</a>
                @if($publications->isNotEmpty())
                    @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                        @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                    @endfor
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            {{$publications->links()}}
                        </div>
                    </div>
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="text-center">No publications were found.</h4>
                            <h5 class="text-danger text-center">If you have just registered , and if you have selected one dblp profile,
                                please wait few minutes and refresh the page to see your publications.</h5>

                        </div>
                    </div>
                @endif

            </div>

            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                <a href="{{ route('groups.create') }}" class="btn btn-primary my-2"><i
                            class="fas fa-plus mr-2"></i>Create new group</a>
                @if($groups->isNotEmpty())
                    @include('groups.includes.group_card' , ['groups' => $groups])
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>Groups</h4>
                        </div>
                        <div class="card-body">
                            <h4>You don't belong to any group.</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection

