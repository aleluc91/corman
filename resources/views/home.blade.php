@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">

                <div class="row justify-content-md-end justify-content-lg-end">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        @include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])
                    </div>
                </div>

                @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                    @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i]])
                @endfor

                <div class="row">
                    <div class="col-md-8">
                        {{$publications->links()}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
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

