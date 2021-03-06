<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $user = factory(\App\User::class)->create();
        $authorId = factory(\App\Author::class)->create([
            'dblp_id' => $user->dblp_id
        ])->id;
        $publications = factory(\App\Publication::class, 20)
            ->create()
            ->each(function ($p) use ($authorId) {
                $authors = factory(\App\Author::class , 4)->make();
                $authorsList = array();
                array_push($authorsList , $authorId);
                foreach($authors as $author) {
                    $find = \App\Author::where('dblp_id', $author->dblp_id)->exists();
                    if(!$find){
                        $author->save();
                        array_push($authorsList , $author->id);
                    }else{
                        array_push($authorsList , \App\Author::where('dblp_id' , $author->dblp_id)->first()->id);
                    }
                }
                $value = rand(0, 1);
                if ($value === 1) {
                    $p->authors()->save($author);
                }
                $p->authors()->attach($authorsList);
                $topics = factory(\App\Topic::class , 3)->make();
                $topicsId = array();
                foreach($topics as $topic) {
                    $topic->save();
                    array_push($topicsId, $topic->id);
                }
                $p->topics()->attach($topicsId);
                $multimedias = factory(\App\Multimedia::class , 2)->create([
                   'publication_id' => $p->id
                ]);
            });
    }

    /**
     * @test
     */
    public function a_user_can_find_all_its_pubications()
    {
        $publications = \App\User::find(1)->author->publications;
        $publicationsCount = \App\Publication::all()->count();
        $this->assertCount($publicationsCount, $publications);
    }

    /**
     * @test
     */
    public function aUserCanFindAllItsPublicationsAndItsAuthors()
    {

    }

    /**
     * @test
     */
    public function a_user_can_view_one_publication()
    {
        $publication = \App\User::find(1)->author->publications->first();
        $this->assertNotNull($publication);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_authors_of_selected_publication()
    {
        //$authors = \App\User::find(1)->author->publications->first()->authors;
        $user = \App\User::with('author.publications.authors')->find(1);
        $this->assertNotEmpty($user->author->publications[1]->authors);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_authors_image_of_selected_publication()
    {
        $authors = \App\User::find(1)->author->publications->first()->authors;
        $images = array();
        foreach ($authors as $author) {
            $user = $author->user;
            if (!empty($user))
                array_push($images, $user->avatar);
            else
                array_push($images, "avatar.jpg");
        }
        $this->assertNotEmpty($images);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_topics_of_selected_publication()
    {
        $publication = \App\Publication::with('topics')->find(2);
        $this->assertNotNull($publication->topics);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_author_and_topics_of_selected_publication()
    {
        $user = \App\User::with('author.publications')->find(1);
        foreach($user->author->publications as $publication){
            var_dump("1");
            foreach($publication->authors as $author)
                var_dump($author->name);
            foreach($publication->topics as $topic)
                var_dump($topic->name);
        }
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function a_user_can_store_a_multimedia_for_selected_publication(){
        $user = \App\User::with('author.publications')->find(1);
        $publicationId = $user->author->publications[0]->id;
        $multimedia = factory(\App\Multimedia::class)->create([
            'publication_id' => $publicationId
        ]);
        $this->assertNotEmpty($multimedia);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_multimedias_of_selected_publication(){
        $user = \App\User::with('author.publications')->find(1);
        $publication = $user->author->publications[0];
        $this->assertNotEmpty($publication->multimedias);
    }

    /**
     * @test
     */
    public function a_user_can_filter_his_publication_by_type(){
        $user = \App\User::with('author.publications')->find(1);
        $filteredPublication = $user->author->publications->where('type' , 'Journal Articles');
        $notFilteredPublication = $user->author->publications->where('type' , '!=' , 'Journal Articles');
        $filterePublicationCount = count($filteredPublication);
        $notFilterePublicationCount = count($notFilteredPublication);
        $totalPublication = count($user->author->publications);
        $this->assertCount($totalPublication - $notFilterePublicationCount , $filteredPublication);
    }

    /**
     * @test
     */
    public function a_user_can_find_all_publications_topics_without_duplicate(){
        $userTopic = \App\User::with('author.publications.topics')->find(1);
        $topicsCollection = collect([]);
        $userTopic->author->publications->each(function($item , $key) use($topicsCollection){
            $item->topics->map(function($item , $key) use($topicsCollection){
                if(!$topicsCollection->contains($item))
                    $topicsCollection->push($item);
            });
        });
        $topicsCollection->map(function($item , $key){
            var_dump($item->name);
        });
        $this->assertNotEmpty($topicsCollection);
    }

}
