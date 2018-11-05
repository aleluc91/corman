<li class="list-group-item">
    <div class="media">
        <img class="align-self-start mr-3" style="width:64px; height:64px;" src="{{ asset('storage/' . $user->avatar) }}" alt="avatar">
        <div class="media-body">
            <div class="row">
                <div class="col-auto">
                    <h4 class="my-auto">{{ $user->name }} {{ $user->last_name }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="row justify-content-end">
                        @if($user->id !== Auth::user()->id)
                            <div class="col-auto">
                                <form class="d-inline" method="POST" action="{{ route('groups.users.update.role') }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" name="groupId" value="{{ $groupId }}">
                                    <label for="role">User role</label>
                                    <div class="form-group form-inline">
                                        <select class="custom-select" name="role" id="role" value="{{ $userRole }}">
                                            <option value="administrator" selected>Administrator</option>
                                            <option value="user">User</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary ml-2">Update role <i class="fas fa-edit ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto">
                                <form class="d-inline" method="POST" action="{{ route('groups.users.destroy' , ['userId' => $user->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" name="groupId" value="{{ $groupId }}">

                                            <button class="btn btn-danger">Delete user <i class="fas fa-trash-alt ml-2"></i>
                                            </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</li>



