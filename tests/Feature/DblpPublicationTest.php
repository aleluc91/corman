<?php

namespace Tests\Feature;

use App\Dblp\DblpAPI;
use Tests\TestCase;
use App\Publication;
use App\Author;

class DblpPublicationTest extends TestCase
{

    /**
     * @test
     */
    public function canStoreAllDblpPublications(){
        $dblpPublicationList = DblpAPI::getAllPublications("Maria Francesca" , "Costabile");
        foreach($dblpPublicationList as $dblpPublication){
            $publication = new Publication();
            $publicationId = $publication->create($dblpPublication->toArray())->id;
            $authors = array();
            foreach($dblpPublication->getAuthors() as $dblpAuthor){
                $authorDblpId = DblpAPI::getAuthorId($dblpAuthor);
                $count = Author::where('dblp_id' , $authorDblpId)->count();
                if($count === 0){
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
        $this->assertDatabaseHas('publications' , $publication->toArray());
    }

    /**
     * @test
     */
    public function cantStoreTheSamePublicationTwice(){
        $dblpPublicationList = DblpAPI::getAllPublications("Maria Francesca" , "Costabile");
        $totalPublication = count($dblpPublicationList);
        $notAdded = array();
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
            }else{
                array_push($notAdded , $dblpPublication);
            }
        }
        $this->assertCount($totalPublication , $notAdded);
    }

}
