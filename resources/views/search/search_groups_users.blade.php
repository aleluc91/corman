@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
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
                        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('groups.show' , $groupId) }}">Back to group page</a></li>
                    </ol>
                </nav>
                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    @for($i = 0 ; $i <= count($users) - 1 ; $i++)
                        <div class="card bg-white my-3 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 ">
                                        <div class="profile-card">
                                            <img class="avatar" src="{{ asset('storage/' . $users[$i]->avatar) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class=" my-3">{{ $users[$i]->name }} {{ $users[$i]->last_name }}</h4>
                                        <h6>
                                            <span class="mr-1"><i class="fas fa-university text-primary"></i></span>
                                            <span class="font-weight-bold">Affiliation :</span>
                                            <span class="text-muted">{{ $users[$i]->affiliation }}</span>
                                        </h6>
                                        <h6>
                                            <span class="mr-1"><i class="fas fa-book text-primary"></i></span>
                                            <span class="font-weight-bold">Lines of research :</span>
                                            <span class="text-muted">{{ $users[$i]->lines_of_research }}</span>
                                        </h6>
                                    </div>
                                </div>

                                <form class="float-right" method="post" action="{{ route('groups.users.invitation') }}">
                                    @csrf
                                    <input type="hidden" name="groupId" value="{{ $groupId }}">
                                    <input type="hidden" name="userId" value="{{ $users[$i]->id }}">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i>Invite</button>
                                </form>
                            </div>
                        </div>
                    @endfor
                @else
                    <div class="card bg-white mb-3">
                        <div class="card-body">
                            <h4 class="text-center">No user was found.</h4>
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