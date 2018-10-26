<?php

namespace App\Http\Controllers;

use App\Author;
use App\Dblp\DblpAPI;
use App\Dblp\DblpPublication;
use App\Jobs\ProcessDblpPublication;
use App\User;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DblpController extends Controller
{
    /**
     * DblpController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->dblp_url = $request->get('url');
        $user->save();
        $authorCount = Author::where('dblp_url' , $request->get('url'))->count();
        if($authorCount === 0){
            $author = new Author;
            $author->name = $request->get('author');
            $author->dblp_url = $request->get('url');
            $author->save();
        }
        ProcessDblpPublication::dispatch(Auth::user()->name, Auth::user()->last_name);
        return redirect()->route('home');
    }
}
