<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    //

    public function show($id){
        $publication = Publication::with(array('authors' , 'publication_tags' , 'multimedias'))->find($id);
        $authors = $publication->authors;
        $tags = $publication->publication_tags;
        $multimedias = $publication->multimedias;

        $authorsImage = array();
        foreach($publication->authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($authorsImage , $user->avatar);
            else
                array_push($authorsImage , "avatar.jpg");
        }

        $publicationMultimedias = array();
        foreach($publication->multimedias as $multimedia){
            array_push($publicationMultimedias , Storage::url($multimedia->url));
        }

        return view('publications.show' , compact('publication' , 'authors' , 'authorsImage' , 'tags' , 'publicationMultimedias'));
    }

    public function edit($id){
        $publication = Publication::with(array('authors' , 'publication_tags' , 'multimedias'))->find($id);
        $authors = $publication->authors;
        $tags = $publication->publication_tags;
        $multimedias = $publication->multimedias;

        $authorsImage = array();
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
