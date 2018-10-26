<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Author;
use App\Dblp\DblpAPI;
use App\Dblp\DblpPublication;
use App\User;
use App\Publication;

class ProcessDblpPublication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $name;
    private $lastName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $name, string $lastName)
    {
        //
        $this->name = $name;
        $this->lastName = $lastName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dblpPublicationList = DblpAPI::getAllPublications($this->name , $this->lastName);
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
    }
}
