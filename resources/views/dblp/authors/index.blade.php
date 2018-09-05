@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white shadow">
                    <div class="card-header bg-white">
                        <h1>Dblp authors founded</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @for($i = 0 ; $i <= count($authors) - 1 ; $i++)
                                <div class="col-md-8 my-2">
                                    <h5><i class="fas fa-user text-danger mr-2"></i>{{ $authors[$i]['author'] }}</h5>
                                    <input type="hidden" value="{{ $authors[$i]['author'] }}">
                                    <i class="fas fa-external-link-alt text-danger mr-2"></i><a
                                            href="{{ $authors[$i]['url'] }}"
                                            target="_blank">{{ $authors[$i]['url'] }}</a>
                                    <input type="hidden" value="{{ $authors[$i]['url'] }}">
                                </div>
                                <div class="col-md-4 my-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal{{$i}}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <form action="{{ route('dblp.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="author" value="{{ $authors[$i]['author'] }}">
                                        <input type="hidden" name="url" value="{{ $authors[$i]['url'] }}">
                                        <button type="submit" class="btn btn-info"><i class="fas fa-check mr-2"></i>Select</button>
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
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger float-right mt-2">Skip this step</button>
            </div>
        </div>
    </div>
@endsection