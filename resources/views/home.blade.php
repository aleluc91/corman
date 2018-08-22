@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                @include('publications.includes.publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'tags' => $tags[$i]])
            @endfor
            <div class="row justify-content-center">
                <div class="col-md-8">
                    {{$publications->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
