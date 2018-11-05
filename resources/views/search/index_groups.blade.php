@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-lg-2">
                <h4>Groups founded</h4>
                @if($groups->isNotEmpty())
                    <ul>
                    @for($i=0 ; $i <= count($groups) - 1 ; $i++)
                        @include('groups.includes.group_search_card' , ['group' => $groups[$i]])
                    @endfor
                    </ul>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">No groups was found.</h4>
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    {{ $groups->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection