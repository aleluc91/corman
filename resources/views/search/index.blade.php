@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    @if(count($users) > 3)
                        <ul class="list-group">
                            @for($i=0 ; $i <= 2 ; $i++)
                                @include('users.includes.user_card_search' , ['user' => $users[$i]])
                            @endfor
                        </ul>
                    @else
                        <ul class="list-group">
                            @for($i=0 ; $i <= count($users) - 1 ; $i++)
                                @include('users.includes.user_card_search' , ['user' => $users[$i]])
                            @endfor
                        </ul>
                    @endif
                    @if(count($users) > 3)
                        <a class="btn btn-primary btn-block mt-2"
                           href="{{ route('search.index.users' , ['value' => $value]) }}">Show more</a>
                    @endif
                @else
                    <div class="card bg-white mb-3">
                        <div class="card-body">
                            <h4 class="text-center">No user was found.</h4>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <h4>Publications founded</h4>
                @if($publications->isNotEmpty())
                    @if(count($publications) > 3)
                        <ul class="list-group">
                            @for($i=0 ; $i <= 2 ; $i++)
                                @include('publications.includes.publication_card_search' , ['publication' => $publications[$i] , 'topics' => $topics[$i]])
                            @endfor
                        </ul>
                    @else
                        <ul class="list-group">
                            @for($i=0 ; $i <= count($publications) - 1 ; $i++)
                                @include('publications.includes.publication_card_search' , ['publication' => $publications[$i] , 'topics' => $topics[$i]])
                            @endfor
                        </ul>
                    @endif
                    @if(count($publications) > 3)
                        <a class="btn btn-primary btn-block mt-2"
                           href="{{ route('search.index.publications' , ['value' => $value]) }}">Show more</a>
                    @endif
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="text-center">No publications founded.</h4>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <h4>Groups founded</h4>
                @if($groups->isNotEmpty())
                    @if(count($groups) > 3)
                        <ul class="list-group">
                        @for($i=0 ; $i <= 2 ; $i++)
                            @include('groups.includes.group_search_card' , ['group' => $groups[$i]])
                        @endfor
                        </ul>
                    @else
                        <ul class="list-group">
                        @for($i=0 ; $i <= count($groups) - 1 ; $i++)
                            @include('groups.includes.group_search_card' , ['group' => $groups[$i]])
                        @endfor
                        </ul>
                    @endif
                    @if(count($groups) > 3)
                        <a class="btn btn-primary btn-block mt-2"
                           href="{{ route('search.index.groups' , ['value' => $value]) }}">Show more</a>
                    @endif
                @else
                    <div class="card bg-white">
                        <div class="card-body">
                            <h4 class="text-center">No groups founded.</h4>
                        </div>
                    </div>
                @endif
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
