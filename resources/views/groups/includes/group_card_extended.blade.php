<div class="card my-2">

    <div class="card-header">
        <h4 class="text-dark text-center my-2">{{ $group->name }}</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h6>{{ $group->description }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($groupRole === 'super_administrator')
                    <button class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteGroupModal">Delete<i
                                class="fa fa-trash-alt ml-2"></i>
                    </button>

                    <div class="modal fade" id="deleteGroupModal" tabindex="-1" role="dialog"
                         aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center">Are you sure you want to delete this group?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close<i
                                                class="fas fa-times ml-2"></i>
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
                @if($groupRole === 'super_administrator' or $groupRole === 'administrator')
                    <a href="{{ route('groups.edit' , ['id' => $group->id]) }}" class="btn btn-primary float-right mr-2">Edit<i
                                class="far fa-eye ml-2"></i></a>
                @endif
                <a href="{{ route('groups.show' , ['id' => $group->id]) }}" class="btn btn-primary float-right mr-2">Show<i
                            class="far fa-eye ml-2"></i></a>
            </div>
        </div>

    </div>
</div>