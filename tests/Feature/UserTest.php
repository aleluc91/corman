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
        $publicationsCount = \App\Publication::all()->count();
        $this->assertCount($publicationsCount , $publications);
    }

    /**
     * @test
     */
    public function aUserCanViewOnePublication(){
        $publication = \App\User::find(1)->author->publications->first();
        $this->assertNotNull($publication);
    }

    /**
     * @test
     */
    public function aUserCanViewAllAuthorsOfSelectedPublication(){
        $authors = \App\User::find(1)->author->publications->first()->authors;
        $this->assertNotEmpty($authors);
    }

    /**
     * @test
     */
    public function aUserCanViewAllAuthorsImageOfSelectedPublication(){
        $authors = \App\User::find(1)->author->publications->first()->authors;
        $images = array();
        foreach($authors as $author){
            $user = $author->user;
            if(!empty($user))
                array_push($images , $user->avatar);
            else
                array_push($images , "avatar.jpg");
        }
        $this->assertNotEmpty($images);
    }

}
