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
        $dblpPublications = DblpAPI::getAllPublications($request->get('name') , $request->get('surname'));
        foreach ($dblpPublications as $dblpPublication){
            $publication = new Publication();
            $count = $publication->where('dblp_id' , $publication->dblp_id)->count();
            if($count !== 0){
                $publication->save($dblpPublication->toArray());
                foreach($dblpPublications->getAuthors() as $dblpAuthor){
                    $author = new Author();
                    $author->name = $dblpAuthor;
                    $author->save();
                    $author->publications()->attach($publication->id);
                }
            }
        }
    }
}
