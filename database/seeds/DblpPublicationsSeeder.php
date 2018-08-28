<?php

use Illuminate\Database\Seeder;
use App\Dblp\DblpAPI;
use App\Publication;
use App\Author;

class DblpPublicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeDblpPublication("Giuseppe" , "Desolda");
        $this->storeDblpPublication("Maria Francesca" , "Costabile");
    }

    private function storeDblpPublication($name , $lastName)
    {
        $dblpPublicationList = DblpAPI::getAllPublications($name , $lastName);
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
                $topics = factory(\App\Topic::class , 3)->create();
                $publication->topics()->attach($topics);
            }
        }
    }
}
