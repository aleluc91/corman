@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                @include('publications.includes.publication_card_complete' , ['publications' , $publication])
            </div>
            <div class="col-md-4">
                @include('publications.includes.authors_card' , ['authors' => $authors , 'images' => $images , 'authorsCount' => $authorsCount])
            </div>
        </div>
    </div>
@endsection