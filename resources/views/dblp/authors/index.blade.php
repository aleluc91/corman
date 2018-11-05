@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white shadow">
                    <div class="card-header bg-white">
                        <h1 class="text-center">Dblp authors founded</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($authors->isNotEmpty())
                                @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                                    <div class="col-md-8 my-2">
                                        <h5><i class="fas fa-user text-primary mr-2"></i>{{ $authors[$i]['author'] }}</h5>
                                        <input type="hidden" value="{{ $authors[$i]['author'] }}">
                                        <i class="fas fa-external-link-alt text-primary mr-2"></i><a
                                                href="{{ $authors[$i]['url'] }}"
                                                target="_blank">{{ $authors[$i]['url'] }}</a>
                                        <input type="hidden" value="{{ $authors[$i]['url'] }}">
                                    </div>
                                    <div class="col-md-4 my-2">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#modal{{$i}}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <form class="d-inline" action="{{ route('dblp.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="author" value="{{ $authors[$i]['author'] }}">
                                            <input type="hidden" name="url" value="{{ $authors[$i]['url'] }}">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-check mr-2"></i>Select</button>
                                        </form>

                                    </div>

                                    <div class="modal fade" id="modal{{$i}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">{{ $authors[$i]['url'] }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="embed-responsive embed-responsive-4by3">
                                                        <iframe class="embed-responsive-item"
                                                                src="{{ $authors[$i]['url'] }}">
                                                            <h5></h5>
                                                        </iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                <h4 class="text-center">No author was found with this name on dblp</h4>
                            @endif

                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('dblp.authors.store') }}">
                    @csrf
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="lastName" value="{{ Auth::user()->last_name }}">
                    @if($authors->isNotEmpty())
                        <button type="submit" class="btn btn-danger float-right mt-2">Skip this step<i class="fas fa-arrow-right ml-2"></i></button>
                    @else
                        <button type="submit" class="btn btn-info float-right mt-2">Continue<i class="fas fa-arrow-right ml-2"></i></button>
                    @endif
                </form>

            </div>
        </div>
    </div>
@endsection