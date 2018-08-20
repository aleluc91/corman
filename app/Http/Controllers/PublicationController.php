<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    //

    public function show($id){
        $publication = User::find(Auth::user()->id)->author->publications->find($id);

        $authors = $publication->authors;

        $images = array();
        foreach($authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($images , $user->avatar);
            else
                array_push($images , "avatar.jpg");
        }

        return view('publications.show' , [
            'publication' => $publication,
            'authors' => $authors,
            'images' => $images,
            'authorsCount' => count($authors)
        ]);
    }

    public function store(Request $request){


    }

}
