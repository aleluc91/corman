<div class="card">
    <div class="card-header">
        <h4>Groups</h4>
    </div>
    <div class="card-body">
            <div class="list-group">
                    
                    @foreach($groups as $group)
                    <a href="{{ route('groups.show' , ['id' => $group->id]) }}" type="button" class="list-group-item list-group-item-action list-group-item-primary my-2">
                            {{ $group->name }}
                    </a>
                        
                    @endforeach
                    </div>
    </div>
</div>

