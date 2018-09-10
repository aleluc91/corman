<?php

namespace App\Http\Controllers;

use App\Author;
use App\Dblp\DblpAPI;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){
        $name = $request->get('name') . ' ' . $request->get('lastName');
        $dblpUrl = 'corman/uid/' . strval(Auth::user()->id);
        $author = new Author();
        $author->name = $name;
        $author->dblp_url = $dblpUrl;
        $author->save();
        $user = User::find(Auth::user()->id);
        $user->dblp_url = $dblpUrl;
        $user->save();
        return redirect()->route('home');
    }

}
