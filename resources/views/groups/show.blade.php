@extends('layouts.app')

@section('content')
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class=" jumbotron jumbotron-fluid"
         style="
                 background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url({{ asset('storage/' . $group->image_url) }});
                 background-size: cover;
                 background-repeat: no-repeat">
        <div class="container-fluid">
            <h1 class="display-4 text-center text-white">{{ $group->name }}</h1>
            <h5 class="text-center text-white">{{ $group->description }}</h5>
        </div>
    </div>
    @if($group->privacy === 'public' or Auth::user()->groups->find($group->id))
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col 12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                @if(Auth::user()->groups->find($group->id))
                                    <a href="{{ route('groups.users.publications' , ['groupId' => $group->id]) }}"
                                        class="btn btn-primary">Share publication<i class="fas fa-share ml-2"></i></a>
                                @endif
                            </div>
                        </div>

                        @if($publications->isNotEmpty())
                            @for($i = 0 ; $i <= count($publications) - 1 ; $i++)
                                @include('groups.includes.group_publication_card' , ['publication' => $publications[$i] , 'authors' => $authors[$i] , 'topics' => $topics[$i] , 'role' => $role , 'groupId' => $group->id])
                            @endfor
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    {{$publications->links()}}
                                </div>
                            </div>
                        @else
                            <div class="card bg-white mt-3">
                                <div class="card-body">
                                    <h3 class="text-center">No publications have been shared in this group.</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        @if(($role === 'super_administrator') or ($role === 'administrator'))
                            <h5>Search for authors to add</h5>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" id="searchUser" type="text"
                                       placeholder="Search user"
                                       autocomplete="off">
                                <input id="groupId" type="hidden" value="{{ $group->id }}">
                                <button id="btnSearchUser" class="btn btn-primary my-2 my-sm-0" type="submit">Search<i
                                            class="fas fa-search ml-2"></i>
                                </button>
                            </form>
                        @endif
                        @if($users->isNotEmpty())
                            <h5 class="mt-4">Registered users</h5>
                            @if($role === 'super_administrator')
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <a href="{{ route('groups.users' , ['groupId' => $group->id]) }}" class="btn btn-primary">Manage users<i class="fas fa-users-cog ml-2"></i></a>
                                    </div>
                                </div>
                            @endif
                            @for($i = 0 ; $i <= count($users) - 1 ; $i++)
                                @include('groups.includes.group_users_card' , ['user' => $users[$i] , 'userRole' => $usersRole[$i] ])
                            @endfor
                        @else
                            <div class="card bg-white my-2">
                                <div class="card-body">

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-danger text-center">This group is private</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
@endsection

@push('body.scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

        })
    </script>
@endpush