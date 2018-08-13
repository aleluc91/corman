
<div class="profile-card">
    <div class="profile-card-header">
        <img src="{{ asset('storage/background-1.jpg') }}" alt="card header background">
    </div>
    <div class="profile-card-body">
        <img class="avatar" src="{{ asset('storage/avatar.jpg') }}" alt="user avatar">
        <div class="profile-data">
            <h3 class="text-center">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>
            <ul>
                <li class="text-center"><i class="far fa-envelope"></i>  {{  Auth::user()->email }}</li>
                <li class="text-center"><i class="fas fa-university"></i>  {{ Auth::user()->affiliation }}</li>
            </ul>
        </div>
    </div>
    <div class="profile-card-footer">
        @if(Route::currentRouteName() === 'users.index')
            <a class="float-right" href="{{ route('users.edit') }}">Edit</a>
        @endif
    </div>


</div>