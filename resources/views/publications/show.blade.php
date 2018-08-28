@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.css')}}"/>
    @endpush

    <div class="container mt-3">
        <h4 class="text-primary">{{$publication['type']}}</h4>
        <h3>{{$publication['title']}}</h3>
        <div class="row mt-3">
            <div class="col-md-5">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <h4>Image and video</h4>
                    </div>
                    <div class="card-body">
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
                                            <img class="d-block w-100" src="{{ asset($publicationMultimedias[$i]) }}"
                                                 alt="Multimedia for current publication">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ asset($publicationMultimedias[$i]) }}"
                                                 alt="Multimedia for current publication">
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
                </div>


            </div>
            <div class="col-md-7">
                <div class="card bg-white">
                    <div class="card-header bg-white">
                        <h4 class="text-primary">Publications details</h4>
                    </div>
                    <div class="card-body">
                        <h6>Venue : <span class="text-muted">{{ $publication['venue'] }}</span></h6>
                        <h6>Volume : <span class="text-muted">{{ $publication['volume'] }}</span></h6>
                        <h6>Number : {{ $publication['number'] }}</h6>
                        <h6>Description :</h6>
                        @if(!empty($publication['description']))
                            <p>{{$publication['description']}}</p>
                        @else
                            <p class="text-muted">This publication has no description.</p>
                        @endif
                        <h6>Topics : </h6>
                        @if($topics->isNotEmpty())
                            <div>
                                @foreach($topics as $topic)
                                    <h5 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span></h5>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">This publication has no topic.</p>
                        @endif
                        <div class="my-3">
                            <h5>Authors :</h5>
                            @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                                <ul class="list-group">
                                    <li class="list-group-item"><img class="rounded"
                                                                     style="height: 30px; width: 30px;"
                                                                     src="{{ asset('storage/'. $authorsImage[$i]) }}"/> {{$authors[$i]->name}}
                                    </li>
                                </ul>
                            @endfor
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <a href="{{ route('publications.edit' , ['id' => $publication['id']]) }}" class="btn btn-info float-right mt-3"><span
                    class="mr-2"><i class="fa fa-edit"></i></span>Edit publication</a>

    </div>

@endsection