<?php

namespace App\Http\Controllers;

use App\Author;
use App\Dblp\DblpAPI;
use App\Dblp\DblpPublication;
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
        $dblpPublicationList = DblpAPI::getAllPublications(Auth::user()->name , Auth::user()->last_name);
        if($dblpPublicationList->isNotEmpty()){
            foreach($dblpPublicationList as $dblpPublication){
                $publicationCount = Publication::where('key' , $dblpPublication->getKey())->count();
                if($publicationCount === 0){
                    $publication = new Publication();
                    $publicationId = $publication->create($dblpPublication->toArray())->id;
                    $authors = array();
                    foreach($dblpPublication->getAuthors() as $dblpAuthor){
                        $authorDblpUrl = DblpAPI::getAuthorUrl($dblpAuthor);
                        $authorCount = Author::where('dblp_url' , $authorDblpUrl)->count();
                        if($authorCount === 0){
                            $author = new Author();
                            $authorData = array('name' => $dblpAuthor , 'dblp_url' => $authorDblpUrl);
                            $authorId = $author->create($authorData)->id;
                            array_push($authors , $authorId);
                        }else{
                            $author = Author::where('dblp_url' , $authorDblpUrl)->first();
                            array_push($authors , $author->id);
                        }
                    }
                    $publication = Publication::find($publicationId);
                    $publication->authors()->attach($authors);
                }
            }
        }
        return redirect()->route('home');
    }
}
