

    <li class="list-group-item">

        <div class="row">
            <div class="col-auto">
                <img src="{{ asset('storage/' . $user->avatar)}}" alt="avatar" style="height: 40px; width: 40px">
            </div>
            <div class="col-auto">
                <h4 class="">
                    <a class="text-primary" href="{{ route('users.show' , $user->id) }}">
                        {{ $user->name }} {{ $user->last_name }}
                    </a>
                </h4>
            </div>
        </div>

    </li>


