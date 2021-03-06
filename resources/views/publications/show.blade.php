@extends('layouts.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.css')}}"/>
    @endpush

    <div class="container mt-3">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h4 class="text-primary">{{$publication->type}}</h4>
        <h3>{{$publication->title}}</h3>

            <div class="row justify-content-end">
                <div class="col-auto">
                    @if($authorsDblpUrl->contains(Auth::user()->dblp_url))
                        <a href="{{ route('publications.edit' , ['id' => $publication['id']]) }}"
                           class="btn btn-primary float-right mt-3">Edit publication<i class="fa fa-edit ml-2"></i></a>
                    @endif
                </div>
            </div>

        <div class="row mt-3">

            <div class="col-md-6">

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="text-dark">Publications details</h4>
                            </div>
                            <div class="card-body">
                                @if($publication->type === 'Journal Articles')
                                    <h6 class="text-dark">Venue : <span
                                                class="text-muted">{{ $publication->venue }}</span></h6>
                                    <h6 class="text-dark">Pages : <span
                                                class="text-muted">{{ $publication->pages }}</span></h6>
                                @elseif($publication->type === 'Conference and Workshop Papers')
                                    <h6 class="text-dark">Venue : <span
                                                class="text-muted">{{ $publication->venue }}</span></h6>
                                    <h6 class="text-dark">Volume : <span
                                                class="text-muted">{{ $publication->volume }}</span>
                                    </h6>
                                    <h6 class="text-dark">Number : <span
                                                class="text-muted">{{ $publication->number }}</span>
                                    </h6>
                                    <h6 class="text-dark">Pages : <span
                                                class="text-muted">{{ $publication->pages }}</span></h6>
                                @elseif($publication->type === 'Editorship')
                                    <h6 class="text-dark">Venue : <span
                                                class="text-muted">{{ $publication->venue }}</span></h6>
                                    <h6 class="text-dark">Publisher : <span
                                                class="text-muted">{{ $publication->publisher }}</span></h6>
                                    <h6 class="text-dark">Volume : <span
                                                class="text-muted">{{ $publication->volume }}</span>
                                    </h6>
                                @elseif($publication->type === 'Parts in Books or Collections')
                                    <h6 class="text-dark">Venue : <span
                                                class="text-muted">{{ $publication->venue }}</span></h6>
                                    <h6 class="text-dark">Pages : <span
                                                class="text-muted">{{ $publication->pages }}</span></h6>
                                @endif
                                <h6 class="text-dark">Description :</h6>
                                @if(!empty($publication->description))
                                    <p class="text-muted">{{ $publication->description }}</p>
                                @else
                                    <p class="text-muted">This publication has no description.</p>
                                @endif
                                <h6 class="text-dark">Link :
                                    <a class="text-info" target="_blank"
                                       href="{{ $publication->ee }}">{{ $publication->ee }}</a>
                                </h6>
                                <h6 class="text-dark">Topics : </h6>
                                @if($topics->isNotEmpty())
                                    <div>
                                        @foreach($topics as $topic)
                                            <h5 class="d-inline"><span class="badge badge-info">{{$topic->name}}</span>
                                            </h5>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">This publication has no topic.</p>
                                @endif

                                <h6 class="text-dark mt-1">Presentation file :</h6>
                                @if(!empty($publicationPresentation))
                                    <ul class="list-unstyled">
                                        @if(count($publicationPresentation)  < 5)
                                            @foreach($publicationPresentation as $multimedia)
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-10 col-sm-8">
                                                            @if($multimedia->type === 'pdf')
                                                                <i class="far fa-file-pdf text-danger mr-2"></i>
                                                            @elseif(($multimedia->type === 'doc') or ($multimedia->type === 'docx'))
                                                                <i class="far fa-file-word text-danger mr-2"></i>
                                                            @elseif(($multimedia->type === 'ppt') or ($multimedia->type === 'pptx'))
                                                                <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                                            @endif
                                                            <a class="mr-3"
                                                               href="{{ asset('storage/' . $multimedia->url) }}"
                                                               target="_blank">{{ $multimedia->name }}</a>
                                                        </div>
                                                        <div class="col-md-2 col-sm-4">
                                                            <button type="submit" class="btn btn-link "><i
                                                                        class="fas fa-trash-alt text-danger"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            @for($i = 0 ; $i <= 4 ; $i++)
                                                <li>
                                                    @if($publicationPresentation[$i]->type === 'pdf')
                                                        <i class="far fa-file-pdf text-danger mr-2"></i>
                                                    @elseif(($publicationPresentation[$i]->type === 'doc') or ($publicationPresentation[$i]->type === 'docx'))
                                                        <i class="far fa-file-word text-danger mr-2"></i>
                                                    @elseif(($publicationPresentation[$i]->type === 'ppt') or ($publicationPresentation[$i]->type === 'pptx'))
                                                        <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                                    @endif
                                                    <a class=""
                                                       href="{{ asset('storage/' . $publicationPresentation[$i]->url) }}"
                                                       target="_blank">{{ $publicationPresentation[$i]->name }}</a>

                                                </li>
                                            @endfor
                                            @for($i = 4 ; $i <= count($publicationPresentation) - 1 ; $i++)
                                                <li class="presentationHide" style="display: none">
                                                    @if($publicationPresentation[$i]->type === 'pdf')
                                                        <i class="far fa-file-pdf text-danger mr-2"></i>
                                                    @elseif(($publicationPresentation[$i]->type === 'doc') or ($publicationPresentation[$i]->type === 'docx'))
                                                        <i class="far fa-file-word text-danger mr-2"></i>
                                                    @elseif(($publicationPresentation[$i]->type === 'ppt') or ($publicationPresentation[$i]->type === 'pptx'))
                                                        <i class="far fa-file-powerpoint text-danger mr-2"></i>
                                                    @endif
                                                    <a class=""
                                                       href="{{ asset('storage/' . $publicationPresentation[$i]->url) }}"
                                                       target="_blank">{{ $publicationPresentation[$i]->name }}</a>
                                                </li>
                                            @endfor
                                            <li>
                                                <button id="presentationShow" class="btn btn-link">
                                                    <i class="fas fa-plus text-info mr-2"></i><span
                                                            class="text-info">More</span>
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                @else
                                    <h6>The are no presentation file for this publication.</h6>
                                @endif


                                <div class="my-3">
                                    <h6 class="text-dark">Authors :</h6>
                                    @if(!empty($authors))
                                        <ul class="list-inline">
                                            @foreach($authors as $author)
                                                @if($author['author']->dblp_url !== Auth::user()->dblp_url)
                                                    <li class="list-inline-item">
                                                        @if($author['active'] === true)
                                                            <a class="text-primary"
                                                               href="{{ route('authors.show' , array('id' => $author['author']->id )) }}">
                                                                <i class="far fa-user mr-2 text-dark"></i>
                                                                {{$author['author']->name}}
                                                            </a>
                                                        @else
                                                            <i class="far fa-user mr-2 text-muted"></i>
                                                            <span class="text-muted">{{$author['author']->name}}</span>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">

                <div class="row mt-2">
                    <div class="col-12">
                        @include('publications.includes.publication_multimedia_card_show' , array(
                                    'publicationImages' => $publicationImages,
                                    'publicationVideos' => $publicationVideos,
                                    'publicationAudios' => $publicationAudios
                                ))
                    </div>
                </div>


            </div>

        </div>

    </div>

@endsection

@push('body.scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

            $('#presentationShow').on('click', function () {
                $('.presentationHide').toggle('slow');
            })
        })

    </script>
@endpush()