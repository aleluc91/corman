<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id){
        $publication = Publication::with(array('authors' , 'topics' , 'multimedias'))->find($id);
        $authors = $publication->authors;
        $topics = $publication->topics;
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

        return view('publications.show' , compact('publication' , 'authors' , 'authorsImage' , 'topics' , 'publicationMultimedias'));
    }

    public function edit($id){
        $publication = Publication::with(array('authors' , 'topics' , 'multimedias'))->find($id);
        $authors = $publication->authors;
        $topics = $publication->topics;
        $multimedias = $publication->multimedias;

        $authorsImage = array();
        foreach($publication->authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($authorsImage , $user->avatar);
            else
                array_push($authorsImage , "avatar.jpg");
        }



        return view('publications.edit', compact('publication' , 'authors' , 'authorsImage' , 'topics' , 'multimedias'));

    }

    public function filter($type , $value){
        $publications = null;
        switch ($type){
            case "type":
                $publications = \App\Publication::with(['authors' , 'topics'])->whereHas('authors' , function($query){
                    $query->where('dblp_id' , '=' , Auth::user()->dblp_id);
                })->where($type , $value);
                break;
            case "topic":
                break;
            case "year":
                $publications = \App\Publication::with(['authors' , 'topics'])->whereHas('authors' , function($query){
                    $query->where('dblp_id' , '=' , Auth::user()->dblp_id);
                })->where($type , $value);
                break;
        }
        $authors = collect([]);
        $topics = collect([]);
        $publications->each(function($item , $key) use($authors , $topics){
            $authors->push($item->authors);
            $topics->push($item->topics);
        });
        $publications = $publications->paginate(10);
        return view('publications.filter' , compact('publications' , 'authors' , 'topics'));
    }

}
