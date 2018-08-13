<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersProfileController extends Controller
{

    /**
     * UsersProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.index');
    }

    public function update(Request $request , $id){
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->last_name = $request->get('lastName');
        $user->email = $request->get('email');
        $user->date_of_birth = $request->get('dateOfBirth');
        $user->country = $request->get('country');
        $user->gender = $request->get('gender');
        $user->affiliation = $request->get('affiliation');
        $user->lines_of_research = $request->get('linesOfResearch');
        $user->save();
        return view('users.index');
    }

}
