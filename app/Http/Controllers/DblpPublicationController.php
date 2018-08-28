<?php

namespace App\Http\Controllers;

use App\Author;
use App\Dblp\DblpAPI;
use App\Dblp\DblpPublication;
use Illuminate\Http\Request;

class DblpPublicationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $dblpPublicationList = DblpAPI::getAllPublications($request->get('name') , $request->get('last_name'));
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
}
