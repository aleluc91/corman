
<div class="card">
    <div class="card-header">

            <div class="profile-card">
                    <img class="avatar" src="{{ asset('storage/' . $user->avatar) }}" alt="User avatar">
                </div>
                <h3 class="text-center my-3">
                    @if(($user->privacy === 'private') and ($user->id !== Auth::user()->id))
                        {{ $user->name }} {{ $user->last_name }}
                    @else
                        <a class="text-primary" href="{{ route('users.show' , $user->id) }}">
                            {{ $user->name }} {{ $user->last_name }}
                        </a>
                    @endif
                </h3>

    </div>
    <div class="card-body">
        
        @if(($user->privacy === 'private') and ($user->id !== Auth::user()->id))
            <h5 class="text-center text-danger">This profile is private.</h5>
            <p class="small text-center">You can not see more information.</p>
        @else
            <p>
                <span class="mr-1"><i class="fas fa-envelope text-primary"></i></span>
                <span class="font-weight-bold">Email :</span>
                <span class="text-muted"> {{ $user->email }} </span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-calendar text-primary"></i></span>
                <span class="font-weight-bold">Date of birth :</span>
                <span class="text-muted">{{ date('d/m/Y', strtotime($user->date_of_birth)) }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-map-marker-alt text-primary"></i></span>
                <span class="font-weight-bold">Country :</span>
                <span class="text-muted">{{ $user->country }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-venus-mars text-primary"></i></span>
                <span class="font-weight-bold">Gender :</span>
                <span class="text-muted">{{ $user->gender }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-university text-primary"></i></span>
                <span class="font-weight-bold">Affiliation :</span>
                <span class="text-muted">{{ $user->affiliation }}</span>
            </p>
            <p>
                <span class="mr-1"><i class="fas fa-book text-primary"></i></span>
                <span class="font-weight-bold">Lines of research :</span>
                <span class="text-muted">{{ $user->lines_of_research }}</span>
            </p>
        @endif
    </div>
</div>
