<div class="card bg-white my-3 shadow">
    <div class="card-body">

        <div class="row">
            <div class="col-md-5 ">

                <div class="profile-card">
                    <img class="avatar" src="{{ asset('storage/' . $user->avatar) }}">
                </div>
            </div>
            <div class="col-md-7">
                <h4 class=" my-3">{{ $user->name }} {{ $user->last_name }}</h4>
                <h6>
                    <span class="mr-1"><i class="fas fa-university text-danger"></i></span>
                    <span class="font-weight-bold">Affiliation :</span>
                    <span class="text-muted">{{ $user->affiliation }}</span>
                </h6>
                <h6>
                    <span class="mr-1"><i class="fas fa-book text-danger"></i></span>
                    <span class="font-weight-bold">Lines of research :</span>
                    <span class="text-muted">{{ $user->lines_of_research }}</span>
                </h6>
            </div>
        </div>


    </div>
</div>

