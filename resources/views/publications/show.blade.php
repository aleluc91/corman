@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.css')}}"/>
    @endpush

    <div class="container mt-3">
        <h4 class="text-primary">{{$publication['type']}}
        <h3>{{$publication['title']}}</h3>
        <div class="row mt-3">
            <div class="col-md-5">
                <div id="carouselMultimedia" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i = 0 ; $i <= count($publicationMultimedias) - 1 ; $i++)
                        <li data-target="#carouselMultimedia" data-slide-to="{{$i}}" class="active"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for($i = 0 ; $i <= count($publicationMultimedias) - 1 ; $i++)
                            @if($i === 0)
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset($publicationMultimedias[$i]) }}" alt="Multimedia for current publication">
                                </div>
                            @else
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset($publicationMultimedias[$i]) }}" alt="Multimedia for current publication">
                                </div>
                            @endif

                        @endfor
                    </div>
                    <a class="carousel-control-prev" href="#carouselMultimedia" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselMultimedia" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <p>Venue : <span class="text-muted">{{ $publication['venue'] }}</span></p>
                <p>Volume : <span class="text-muted">{{ $publication['volume'] }}</span></p>
                <p>Number : {{ $publication['number'] }}</p>
                <p>Description :</p>
                @if(!empty($publication['description']))
                    <p>{{$publication['description']}}</p>
                @else
                    <p class="text-muted">This publication has no description.</p>
                @endif
                <p>Topics : </p>
                @if($topics->isNotEmpty())
                    <p>
                        @foreach($topics as $topic)
                            <span class="badge badge-info">{{$topic->name}}</span>
                        @endforeach
                    </p>
                @else
                    <p class="text-muted">This publication has no topic.</p>
                @endif
                <div>
                    @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                    <ul>
                        <li class="authors-card-image"> <img src="{{ asset('storage/'. $authorsImage[$i]) }}"/> {{$authors[$i]->name}}</li>
                    </ul>
                    @endfor
                </div>
               {{-- @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                    <div class="row mb-4">
                        <div class="col-md-4 authors-card-image">
                            <img src="{{ asset('storage/'. $images[$i]) }}"/>
                        </div>
                        <div class="col-md-8">
                            {{$authors[$i]->name}}
                        </div>
                    </div>
                @endfor--}}
            </div>
            {{--<div class="col-md-3">
                @include('publications.includes.authors_card' , ['authors' => $authors , 'images' => $images])
            </div>--}}
        </div>

        {{--<div class="row">
            <div class="col-md-5">
                <div class="publicationSlider">
                    <div><img src="https://via.placeholder.com/500x400" class="img-fluid"></div>
                    <div><img src="https://via.placeholder.com/400x400" class="img-fluid"></div>
                    <div><img src="https://via.placeholder.com/400x400" class="img-fluid"></div>
                    <div><img src="https://via.placeholder.com/400x400" class="img-fluid"></div>
                    <div><img src="https://via.placeholder.com/400x400" class="img-fluid"></div>
                </div>
            </div>
        </div>--}}
        {{--<div class="row">
            <div class="col-md-8">
                @include('publications.includes.publication_card_complete' , ['publication' => $publication , 'tags' => $tags])
            </div>
            <div class="col-md-4">
                @include('publications.includes.authors_card' , ['authors' => $authors , 'images' => $images])
            </div>
        </div>--}}

                <a href="{{ route('publications.edit' , ['id' => $publication['id']]) }}" class="btn btn-info float-right"><span class="mr-2"><i class="fa fa-edit"></i></span>Edit publication</a>

    </div>

@endsection