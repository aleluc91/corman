
<div class="card">
    <div class="card-header bg-white">

        <img class="rounded-circle avatar text-center" src="{{ asset('storage/avatar.jpg') }}"
             alt="user avatar">
        <h3 class="text-center">{{Auth::user()->name}} {{Auth::user()->last_name}}</h3>

    </div>
    <div class="card-body bg-white">
        <ul>
            <li><i class="far fa-envelope"></i> <span
                        class="text-muted">Email : </span> {{Auth::user()->email}}</li>
            <li><i class="fas fa-calendar-alt"></i> <span
                        class="text-muted">Date of birth : </span> {{Auth::user()->date_of_birth}}</li>
            <li><i class="far fas fa-map-marker-alt"></i> <span
                        class="text-muted">Country : </span> {{Auth::user()->country}}</li>
            <li><i class="far fa-envelope"></i> <span
                        class="text-muted">Gender : </span> {{Auth::user()->gender}}</li>
            <li><i class="far fa-envelope"></i> <span
                        class="text-muted">Affiliation : </span> {{Auth::user()->affiliation}}</li>
            <li><i class="far fa-envelope"></i> <span
                        class="text-muted">Lines of research : </span> {{Auth::user()->lines_of_research}}
            </li>
        </ul>
    </div>
</div>