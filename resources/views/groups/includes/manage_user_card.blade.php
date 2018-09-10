<div class="card bg-white my-2 shadow">
    <div class="card-body">

        <div class="row">
            <div class="col-md-5 col-lg-5">

                <div class="profile-card">
                    <img class="avatar" src="{{ asset('storage/' . $user->avatar) }}">
                </div>
            </div>
            <div class="col-md-7">
                <h4 class=" my-3">{{ $user->name }} {{ $user->last_name }}</h4>
                <h6>
                    <span class="mr-1"><i class="fas fa-university text-danger"></i></span>
                    <span class="font-weight-bold">Affiliation :</span>
                    <span class="text-muted">{{ $user->affiliation }}</span>
                </h6>
                <h6>
                    <span class="mr-1"><i class="fas fa-book text-danger"></i></span>
                    <span class="font-weight-bold">Lines of research :</span>
                    <span class="text-muted">{{ $user->lines_of_research }}</span>
                </h6>
                @if($user->id === Auth::user()->id)
                    <form method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="role">User role</label>
                            <select class="custom-select" name="role" id="role" value="{{ $userRole }}" disabled>
                                <option value="super_administrator">Super administrator</option>
                            </select>
                        </div>
                    </form>
                    <form method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button class="btn btn-danger" disabled>Delete user</button>
                            </div>
                        </div>
                    </form>

                @else
                    <form method="POST" action="{{ route('groups.users.update.role') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <input type="hidden" name="groupId" value="{{ $groupId }}">
                        <div class="form-group">
                            <label for="role">User role</label>
                            <select class="custom-select" name="role" id="role" value="{{ $userRole }}">
                                <option value="administrator" selected>Administrator</option>
                                <option value="user">User</option>
                            </select>
                            <div class="row justify-content-end mt-2">
                                <div class="col-auto">
                                    <button class="btn btn-info">Update role<i class="fas fa-edit ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('groups.users.destroy' , ['userId' => $user->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <input type="hidden" name="groupId" value="{{ $groupId }}">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button class="btn btn-danger">Delete user <i class="fas fa-trash-alt ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        @endif
    </div>


</div>
