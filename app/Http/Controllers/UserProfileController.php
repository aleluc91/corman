<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UserProfileController extends Controller
{

    /**
     * UserProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.index');
    }

    public function show($id){
        $user = User::find($id);
        return view('users.show' , compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.edit' , ['user' => $user]);
    }



    public function update(Request $request){

       \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:40',
            'lastName' => 'required|string|min:2|max:40',
            'date_of_birth' => 'date',
            'country' => 'string',
            'gender' => 'string',
            'email' => [
                'required|email|max:255|',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'affiliation' => 'required|string|max:255',
            'linesOfResearch' => 'required|string|max:255'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->get('name');
        $user->last_name = $request->get('lastName');
        $user->email = $request->get('email');
        $user->date_of_birth = $request->get('dateOfBirth');
        $user->country = $request->get('country');
        $user->gender = $request->get('gender');
        $user->affiliation = $request->get('affiliation');
        $user->lines_of_research = $request->get('linesOfResearch');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($user->avatar !== 'users_image/default_avatar.png'){
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $file->store(
                'users_image', 'public'
            );
            $user->avatar = $path;
        }

        $user->save();
        return redirect()->route('users.show' , $user->id)->with('status' , 'Your profile has been updated!');
    }




}
