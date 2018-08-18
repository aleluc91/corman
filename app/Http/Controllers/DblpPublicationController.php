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
            $publicationCount = Publication::where('dblp_id' , $dblpPublication->getId())->count();
            if($publicationCount === 0){
                $publication = new Publication();
                $publicationId = $publication->create($dblpPublication->toArray())->id;
                $authors = array();
                foreach($dblpPublication->getAuthors() as $dblpAuthor){
                    $authorDblpId = DblpAPI::getAuthorId($dblpAuthor);
                    $authorCount = Author::where('dblp_id' , $authorDblpId)->count();
                    if($authorCount === 0){
                        $author = new Author();
                        $authorData = array('name' => $dblpAuthor , 'dblp_id' => $authorDblpId);
                        $authorId = $author->create($authorData)->id;
                        array_push($authors , $authorId);
                    }else{
                        $author = Author::where('dblp_id' , $authorDblpId)->first();
                        array_push($authors , $author->id);
                    }
                }
                $publication = Publication::find($publicationId);
                $publication->authors()->attach($authors);
            }
        }
    }
}
