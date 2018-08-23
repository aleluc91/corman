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
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://picsum.photos/500/500/?random" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://picsum.photos/400/400/?random" alt="https://picsum.photos/400/400/?random">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://picsum.photos/400/400/?random" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <p>Venue : <span class="text-muted">Test venue</span></p>
                <p>Volume : Test volume</p>
                <p>Number : Test number</p>
                <p>{{$publication['description']}}</p>
                @if(!empty($tags))
                    <p>
                        @foreach($tags as $tag)
                            <span class="badge badge-info">{{$tag->tag}}</span>
                        @endforeach
                    </p>
                @endif
                <div>
                    @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                    <ul>
                        <li class="authors-card-image"> <img src="{{ asset('storage/'. $images[$i]) }}"/> {{$authors[$i]->name}}</li>
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

    @push('scripts')
        <script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.publicationSlider').slick({
                   centerMode: true,
                   slidesToShow: 1,
                   slidesToScroll: 1,
                   dots: true,
                   infinite: true,
                   speed: 500,
                   fade: true,
                   cssEase: 'linear',
                   nextArrow: "<button type='button' class='slick-next pull-right'><i class='far fa-angle-right f044' aria-hidden='true'></i></button>"
               });
               $('.slick-next').css('{color: #90323d}');
            });
        </script>
    @endpush
@endsection