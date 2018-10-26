
<div class="card bg-white my-2">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col sm-12 col-md-4 col-lg-4">
                <img class="img-fluid rounded-circle mx-auto d-block" src="{{ asset('storage/' . $user->avatar) }}" alt="User image">
            </div>
            <div class="col-12 col sm-12 col-md-8 col-lg-8">
                <h5><a class="text-primary" href="{{ route('authors.show' , $user->author->id) }}" class="">{{$user->name}} {{$user->last_name}}</a></h5>
                <h6>Role: <span class="text-danger">{{ $userRole }}</span></h6>
            </div>
        </div>
    </div>
</div>