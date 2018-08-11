
<div class="profile-card">
    <div class="profile-card-header">
        <img src="{{ asset('storage/background-1.jpg') }}" alt="card header background">
    </div>
    <div class="profile-card-body">
        <img class="avatar" src="{{ asset('storage/avatar.jpg') }}" alt="user avatar">
        <h3 class="text-center">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>
        <ul>
            <li class="text-center"><i class="far fa-envelope"></i>  {{  Auth::user()->email }}</li>
            <li class="text-center"><i class="fas fa-university"></i>  {{ Auth::user()->affiliation }}</li>
        </ul>
    </div>
</div>