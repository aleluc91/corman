<?php

namespace App\Http\Controllers;

use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    //

    public function show($id){
        $publication = Publication::with(array('authors' , 'publication_tags'))->find($id);
        //$publication = User::find(Auth::user()->id)->author->publications->find($id);

        $authorsImage = array();
        $authors = $publication->authors;
        $tags = $publication->publication_tags;
        foreach($publication->authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($authorsImage , $user->avatar);
            else
                array_push($authorsImage , "avatar.jpg");
        }

        return view('publications.show' , compact('publication' , 'authors' , 'authorsImage' , 'tags'));
    }

    public function edit($id){
        $publication = Publication::with(array('authors' , 'publication_tags' , 'multimedias'))->find($id);
        $authorsImage = array();
        $authors = $publication->authors;
        $tags = $publication->publication_tags;
        $multimedias = $publication->multimedias;
        foreach($publication->authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($authorsImage , $user->avatar);
            else
                array_push($authorsImage , "avatar.jpg");
        }
        return view('publications.edit', compact('publication' , 'authors' , 'authorsImage' , 'tags' , 'multimedias'));

    }

}
