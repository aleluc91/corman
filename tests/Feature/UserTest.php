<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    /**
     * @test
     */
    public function aUserCanFindAllItsPublications()
    {
        $publications = \App\User::find(1)->author->publications;
        /*foreach($publications as $publication) {
            $authors = $publication->authors;
            var_dump($authors);
        }*/
        $publicationsCount = \App\Publication::all()->count();
        $this->assertCount($publicationsCount , $publications);
    }

}
