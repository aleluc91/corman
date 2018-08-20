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
        $publications = \App\User::find(Auth::user()->id)->author->publications()->paginate(10);
        $authorsList = array();
        foreach($publications as $publication){
            $authors = $publication->authors;
            array_push($authorsList , $authors);
        }
        return view('home' , [
            'publications' => $publications,
            'authors' => $authorsList
        ]);
    }
}
