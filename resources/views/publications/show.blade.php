@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                @include('publications.includes.publication_card_complete' , ['publication' => $publication , 'tags' => $tags])
            </div>
            <div class="col-md-4">
                @include('publications.includes.authors_card' , ['authors' => $authors , 'images' => $images])
            </div>
        </div>
    </div>
@endsection