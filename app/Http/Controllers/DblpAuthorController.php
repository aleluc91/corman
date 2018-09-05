<?php

namespace App\Http\Controllers;

use App\Dblp\DblpAPI;
use Illuminate\Http\Request;

class DblpAuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($name , $lastName)
    {
        $authors = DblpAPI::getAuthors($name , $lastName);
        return view('dblp.authors.index' , compact('authors'));
    }
}
