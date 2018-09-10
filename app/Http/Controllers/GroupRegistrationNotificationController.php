<?php

namespace App\Http\Controllers;

use App\GroupRegistrationNotification;
use Illuminate\Http\Request;

class GroupRegistrationNotificationController extends Controller
{

    public function store(Request $request){
        $notification = new GroupRegistrationNotification();
        $notification->group_id = $request->get('groupId');
        $notification->user_id = $request->get('userId');
        $notification->by_user_id = $request->get('byUserId');
        $notification->save();
        return redirect()->route('groups.show' , $request->get('groupId'))->with('status' , 'The request has been sent successfully!');
    }

    public function destroy($id){
        $notification = GroupRegistrationNotification::find($id);
        $notification->delete();
        return redirect()->back()->with("status" , "Request deleted");
    }

}
