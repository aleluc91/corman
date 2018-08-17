<?php

namespace Tests\Feature;

use App\Dblp\DblpAPI;
use App\Dblp\DblpPublication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Publication;
use App\Author;

class PublicationTest extends TestCase
{

    //use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function canStoreSingleDblpPublications()
    {
        $dblpPublicationList = DblpAPI::getAllPublications("Giuseppe" , "Desolda");
        $dblpPublication = $dblpPublicationList[array_rand($dblpPublicationList , 1)];
        $publication = new Publication();
        $publication->fill($dblpPublication->toArray());
        $publication->save();
        $authors = array();
        foreach($dblpPublication->getAuthors() as $dblpAuthor){
            $author = new Author();
            $author->fill(['name' => $dblpAuthor]);
            $author->save();
            array_push($authors , $author->id);
        }
        $publication->authors()->attach($authors);
        DblpAPI::getAuthorId("Maria Francesca Costabile");
        $this->assertDatabaseHas('publications' , $publication);
    }

}
