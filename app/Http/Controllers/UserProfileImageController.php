<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileImageController extends Controller
{


    /**
     * UserProfileImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $user = User::find($request->get('userId'));
            if($user->avatar !== 'users_image/default.png'){
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $file->store(
                'users_image', 'public'
            );
            $user->avatar = $path;
            $user->save();
            return response()->json(['message' => 'Your file was uploaded correctly.']);
        } else {
            return response()->json(['message' => 'Your request content no file.']);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $path = public_path() . '/' . $user->avatar;
        Storage::disk('public')->delete($user->url);
        return redirect()->back()->with('status', 'Success! The file you have selected has been deleted' );
    }

}
