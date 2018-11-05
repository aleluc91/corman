@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
                <div class="container mt-3">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                <h4>Users founded</h4>
                @if($users->isNotEmpty())
                    <ul>
                    @foreach($users as $user)
                        @include('users.includes.user_card_search' , ['users' => $users])
                    @endforeach
                    </ul>
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