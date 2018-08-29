<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPSTORM_META\map;

class AuthorController extends Controller
{

    /**
     * AuthorController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        $author = \App\Author::with('user')->find($id);
        $publications = \App\Publication::with(['authors' , 'topics'])
            ->whereHas('authors' , function($query) use($id){
                $query->where('authors.id' , $id);
            });
        $user = $author->user;
        $authors = collect([]);
        $topics = collect([]);
        if(!empty($publications)){
            $publications->each(function ($item , $key) use($authors , $topics){
                $localAuthors = collect([]);
                $localAuthorsActive = collect([]);
                $item->authors->map(function ($item, $key) use ($localAuthors , $localAuthorsActive) {
                    $localAuthors->push($item);
                    if($item->user()->exists())
                        $localAuthorsActive->push(true);
                    else
                        $localAuthorsActive->push(false);
                });
                $authors->push(['authors' => $localAuthors , 'active' => $localAuthorsActive]);
                $topics->push($item->topics);
            });
        }
        $publications = $publications->paginate(10);
        return view('authors.show' , compact('user' , 'publications' , 'authors' , 'topics'));
    }

}
