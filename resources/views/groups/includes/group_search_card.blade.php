<li class="list-group-item">
    <div class="row">
        <div class="col-12">
            <h5 class="text-dark text-center my-2">{{ $group->name }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h6>{{ $group->description }}</h6>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="{{ route('groups.show' , ['id' => $group->id]) }}" class="btn btn-primary">Show<i class="far fa-eye ml-2"></i></a>
        </div>
        @if(!Auth::user()->groups->find($group->id))
        <div class="col-auto">
            <form action="{{ route('groups.users.partecipate') }}" method="POST">
                @CSRF
                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                <input type="hidden" name="groupId" value="{{ $group->id }}">
                <button type="submit" class="btn btn-primary">Partecipate</button>
            </form>
        </div>
        @endif
    </div>
</li>
