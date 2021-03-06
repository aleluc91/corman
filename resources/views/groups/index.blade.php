@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row justify-content-end">
                    <div class="col-12">
                        <a href="{{ route('groups.create') }}" class="btn btn-primary float-right">Create new group<i
                                    class="fas fa-plus ml-2"></i></a>
                    </div>
                </div>
                <div class="row mt-2">
                    {{--<h4>Your groups</h4>--}}
                    @if($groups->isNotEmpty())

                        @for($i = 0 ; $i <= count($groups) - 1 ; $i++)
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                @include('groups.includes.group_card_extended' , ['group' => $groups[$i] , 'groupRole' => $groupsRole[$i]])
                            </div>
                        @endfor

                    @else
                        <div class="card bg-white">
                            <div class="card-body">
                                <h4 class="text-center">You don't belong to any group.</h4>
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
        $(document).ready(function () {

            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 4000);

        })
    </script>
@endpush