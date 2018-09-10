
<div class="card bg-white my-2">
    @if(!empty($group->image_url))
        <div class="card-header p-0">
            <img class="card-img-top" src="{{ asset('storage/' . $group->image_url) }}" alt="Group image">
        </div>
    @endif
    <div class="card-body">
        <h4 class="text-info text-center my-2">{{ $group->name }}</h4>
        <h6>{{ $group->description }}</h6>
        @if($groupRole === 'super_administrator')
            <button class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteGroupModal">Delete<i
                        class="fa fa-trash-alt ml-2"></i>
            </button>

            <div class="modal fade" id="deleteGroupModal" tabindex="-1" role="dialog"
                 aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteGroupModalLabel">Delete publication?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">Are you sure you want to delete this publication?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close<i class="fas fa-times ml-2"></i>
                            </button>
                            <form method="POST" action="{{ route('groups.destroy' , ['id' => $group->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete<i class="fas fa-trash-alt ml-2"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <a href="{{ route('groups.show' , ['id' => $group->id]) }}" class="btn btn-info float-right mr-2">Show<i class="far fa-eye ml-2"></i></a>
    </div>
</div>