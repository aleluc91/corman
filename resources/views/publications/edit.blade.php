@extends('layouts.app')

@section('content')



    <div class="container mt-3">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mt-3">

            <div class="col-md-7">
                @include('publications.includes.publication_edit_card')
            </div>

            <div class="col-md-5">
                @include('publications.includes.publication_multimedia_card_edit')
            </div>

        </div>


    </div>

@endsection


