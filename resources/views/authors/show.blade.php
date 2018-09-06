@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                @include('users.includes.user_card' , ['user' => $user])
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                {{--@include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])--}}

                @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                    @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                @endfor

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        {{$publications->links()}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Your Group</h3>
                        <p>Test</p>
                        <p>Test</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection