<?php

namespace App\Http\Controllers;

use App\Dblp\DblpAPI;
use Illuminate\Http\Request;

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
        DblpAPI::getAllPublications('Giuseppe' , 'Desolda');
        DblpAPI::getAuthorId("Maria Francesca Costabile");
        return view('home');
    }
}
