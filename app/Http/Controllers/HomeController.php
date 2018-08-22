<?php

namespace App\Http\Controllers;

use App\Dblp\DblpAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = \App\Publication::with(['authors' , 'publication_tags'])->whereHas('authors' , function($query){
            $query->where('dblp_id' , '=' , Auth::user()->dblp_id);
        })->paginate(10);
        //$user = \App\User::with('author.publications')->find(Auth::user()->id);
        //$publications = $user->author->publications->paginate(10);
        //$publications = \App\User::find(Auth::user()->id)->author->publications()->paginate(10);
        $authors = array();
        $tags = array();
        foreach($publications as $publication)
            array_push($authors , $publication->authors);
        foreach($publications as $publication)
            array_push($tags , $publication->publication_tags);
        return view('home' , compact('publications' , 'authors' , 'tags'));
    }

}
