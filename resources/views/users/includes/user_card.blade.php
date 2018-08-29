
<div class="card bg-white ">
    <div class="card-header bg-white">
        <h3>Profile info</h3>
    </div>
    <div class="card-body">
        <div class="profile-card">
            <img class="avatar" src="{{ asset('storage/' . $user->avatar) }}">
        </div>
        <h3 class="text-center my-3">{{ $user->name }} {{ $user->last_name }}</h3>
        @if($user->privacy === 'private')
            <h5 class="text-center text-danger">This profile is private.</h5>
            <p class="small text-center">We can't show more information about this profile.</p>
        @else
            <p>
                <span class="mr-1"><i class="fas fa-envelope"></i></span>
                <span class="font-weight-bold">Email :</span>
                <span class="text-muted"> {{ $user->email }} </span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-calendar"></i></span>
                <span class="font-weight-bold">Date of birth :</span>
                <span class="text-muted">{{ $user->date_of_birth }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-map-marker-alt"></i></span>
                <span class="font-weight-bold">Country :</span>
                <span class="text-muted">{{ $user->country }}</span>
            </p>
            <p>
                <span class="mr-1"><i class=""></i></span>
                <span class="font-weight-bold">Gender :</span>
                <span class="text-muted">{{ $user->gender }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-university"></i></span>
                <span class="font-weight-bold">Affiliation :</span>
                <span class="text-muted">{{ $user->affiliation }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-book"></i></span>
                <span class="font-weight-bold">Lines of research :</span>
                <span class="text-muted">{{ $user->lines_of_research }}</span>
            </p>
        @endif


    </div>
</div>
