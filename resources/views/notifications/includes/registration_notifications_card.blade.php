<div class="card bg-white">
    <div class="card-header bg-white">
        <h4 class="text-center">Group invitation</h4>
    </div>
    <div class="card-body">
        <h6>Invite to the group:</h6>
        <h6><a href="{{ route('groups.show' , $groupPending->id) }}" class="text-info">{{ $groupPending->name }}</a>
        </h6>
        <h6>Invited by:</h6>
        <h6><a href="{{ Route('users.show' , $userBy->id) }}"
               class="text-info">{{ $userBy->name }} {{ $userBy->last_name }}</a></h6>
        <div class="float-right">
            <form method="POST" action="{{ route('groups.users.store') }}">
                @csrf
                <input type="hidden" name="groupId" value="{{ $registrationNotification->group_id }}">
                <input type="hidden" name="userId" value="{{ $registrationNotification->user_id }}">
                <input type="hidden" name="notificationId" value="{{ $registrationNotification->id }}">
                <a href="{{ route('groups.registration.notification.destroy' , $registrationNotification->id) }}" class="btn btn-danger">Decline</a>
                <button type="submit" class="btn btn-info">Accept</button>
            </form>
        </div>
    </div>
</div>
</div>