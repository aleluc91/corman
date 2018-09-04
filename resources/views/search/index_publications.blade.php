@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
                <h4>Publications founded</h4>
                @if($publications->isNotEmpty())
                    @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                            @include('publications.includes.publication_card_search' , ['publication' => $publications[$i] , 'topics' => $topics[$i]])
                    @endfor
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="text-center">No publication was found.</h4>
                        </div>
                    </div>
                @endif
            <div class="row justify-content-center">
                {{ $publications->links() }}
            </div>
            </div>

        </div>
    </div>
@endsection