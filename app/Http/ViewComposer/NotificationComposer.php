<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 07/09/2018
 * Time: 08:33
 */

namespace App\Http\ViewComposer;


use App\Group;
use App\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{

    protected $registrationNotifications;
    protected $usersBy;
    protected $groupsPending;

    public function __construct()
    {
        $this->registrationNotifications = collect([]);
        $this->groupsPending = collect([]);
        $this->usersBy = collect([]);
        if(Auth::check()){
            $user = User::with(['groupsRegistrationNotifications'])
                ->find(Auth::user()->id);
            if($user->groupsRegistrationNotifications()->exists()) {
                $user->groupsRegistrationNotifications->each(function ($item , $key){
                    $this->registrationNotifications->push($item);
                    $this->groupsPending->push(Group::find($item->group_id));
                    $this->usersBy->push(User::find($item->by_user_id));
                });
            }
        }
    }

    public function compose(View $view){
        $view->with([
            'registrationNotifications' => $this->registrationNotifications,
            'groupsPending' => $this->groupsPending,
            'usersBy' => $this->usersBy
        ]);
    }

}