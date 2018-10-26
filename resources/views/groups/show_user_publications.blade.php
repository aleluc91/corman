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

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-primary" href="{{ route('groups.show' , $groupId) }}">Go back</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                @include('users.includes.user_card' , ['user' => Auth::user()])
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">

                {{--<div class="row justify-content-md-end justify-content-lg-end">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        @include('publications.includes.publication_filtering' , ['singleType' => $singleType , 'singleTopic' => $singleTopic , 'singleYear' => $singleYear ])
                    </div>
                </div>--}}

                @if($publications->isNotEmpty())
                    <div class="row justify-content-end mb-2">
                        <div class="col-auto">
                            <form method="POST" action="{{ route('groups.users.store.publications') }}">
                                @csrf
                                <input type="hidden" name="groupId" value="{{ $groupId }}">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-share mr-2"></i>Share all your publications</button>
                            </form>

                        </div>
                    </div>
                    @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                        @include('groups.includes.group_share_publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i] , 'groupId' => $groupId])
                    @endfor

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            {{$publications->links()}}
                        </div>
                    </div>
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="text-center">No publications were found.</h4>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
    </div>

@endsection

@push('body.scripts')
    <script type="text/javascript">
        $(document).ready(function (){

            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

        })
    </script>
@endpush