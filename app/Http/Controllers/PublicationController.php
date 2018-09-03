<?php

namespace App\Http\Controllers;

use App\Multimedia;
use App\Publication;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($id)
    {
        $publication = Publication::with(array('authors', 'topics', 'multimedias'))->find($id);
        $topics = $publication->topics;

        $authors = collect([]);
        $authorsImage = collect([]);
        $publication->authors->map(function($item, $key) use($authors , $authorsImage){
            $user = $item->user;
            if (!empty($user)) {
                $authorsImage->push($user->avatar);
                $authors->push(['author' => $item, 'active' => true]);
            } else{
                $authorsImage->push("avatar.jpg");
                $authors->push(['author' => $item , 'active' => false]);
            }
        });

        $publicationImages = collect([]);
        $publicationVideos = collect([]);
        $publicationAudios = collect([]);
        $publicationPresentation = collect([]);

        $publication->multimedias->map(function($item , $key) use($publicationImages , $publicationVideos , $publicationAudios , $publicationPresentation){
            if(($item->type === 'image/jpg') or ($item->type === 'image/jpeg') or ($item->type === 'image/png')){
                $publicationImages->push($item);
            }else if(($item->type === 'video/mp4') or ($item->type === 'video/mkv')){
                $publicationVideos->push($item);
            }else if($item->type === 'audio/mpeg')
                $publicationAudios->push($item);
            else{
                $publicationPresentation->push($item);
            }
        });

        return view('publications.show', compact(
            'publication',
            'authors',
            'authorsImage',
            'topics',
            'publicationImages' ,
            'publicationVideos' ,
            'publicationAudios' ,
            'publicationPresentation'
        ));
    }

    public function edit($id)
    {
        $publication = Publication::with(array('authors', 'topics', 'multimedias'))->find($id);
        $publicationMultimedias = Multimedia::where("publication_id" , $id)
            ->whereNotIn('type' , ['pdf' , 'doc' , 'docx' , 'ppt' , 'pptx'])
            ->paginate(5);

        $authors = $publication->authors;
        $topics = $publication->topics;

        $authorsImage = collect([]);
        foreach ($publication->authors as $author) {
            $user = $author->user;
            if (!empty($user))
                $authorsImage->push($user->avatar);
            else
                $authorsImage->push("avatar.jpg");
        }

        $publicationImages = collect([]);
        $publicationVideos = collect([]);
        $publicationAudios = collect([]);
        $publicationPresentation = collect([]);
        $publication->multimedias->map(function($item , $key) use($publicationImages , $publicationVideos , $publicationAudios , $publicationPresentation){
            if(($item->type === 'image/jpg') or ($item->type === 'image/jpeg') or ($item->type === 'image/png')){
                $publicationImages->push($item);
            }else if(($item->type === 'video/mp4') or ($item->type === 'video/mkv')){
                $publicationVideos->push($item);
            }else if($item->type === 'audio/mpeg')
                $publicationAudios->push($item);
            else
                $publicationPresentation->push($item);
        });

        $allTopics = Topic::all();

        return view('publications.edit', compact(
            'publication',
            'authors',
            'authorsImage',
            'topics',
            'allTopics',
            'publicationImages',
            'publicationVideos',
            'publicationAudios',
            'publicationMultimedias',
            'publicationPresentation'
        ));

    }

    public function update(Request $request , $id){
        $publication = Publication::find($id);
        /*$publication->title = $request->get('title');
        $publication->venue = $request->get('venue');
        $publication->publisher = $request->get('publisher');
        $publication->volume = $request->get('volume');
        $publication->number = $request->get('number');
        $publication->pages = $request->get('pages');
        $publication->year = $request->get('year');
        $publication->type = $request->get('type');*/
        $publication->description = $request->get('description');
        $publication->save();
        $publication->topics()->sync($request->get('topics'));
        return redirect()->route('publications.show' , ['id' => $publication->id] )->with('status' , 'Success! The publication data has been updated.');
    }

    public function filter($type, $value)
    {
        $publications = null;
        switch ($type) {
            case "type":
                $publications = \App\Publication::with(['authors', 'topics'])->whereHas('authors', function ($query) {
                    $query->where('dblp_url', '=', Auth::user()->dblp_url);
                })->where($type, $value);
                break;
            case "topic":
                $publications = \App\Publication::with(['authors', 'topics'])
                    ->whereHas('authors', function ($query) {
                        $query->where('dblp_url', '=', Auth::user()->dblp_url);
                    })
                    ->whereHas('topics', function ($query) use ($value) {
                        $query->where('name', $value);
                    });
                break;
            case "year":
                $publications = \App\Publication::with(['authors', 'topics'])->whereHas('authors', function ($query) {
                    $query->where('dblp_url', '=', Auth::user()->dblp_url);
                })->where($type, $value);
                break;
        }
        $authors = collect([]);
        $topics = collect([]);
        $publications->each(function ($item, $key) use ($authors, $topics) {
            $localAuthors = collect([]);
            $localAuthorsActive = collect([]);
            $item->authors->map(function ($item, $key) use ($localAuthors , $localAuthorsActive) {
                $localAuthors->push($item);
                if($item->user()->exists())
                    $localAuthorsActive->push(true);
                else
                    $localAuthorsActive->push(false);
            });
            $authors->push(['authors' => $localAuthors , 'active' => $localAuthorsActive]);
            $topics->push($item->topics);
        });
        $publications = $publications->paginate(10);
        return view('publications.filter', compact(
            'publications',
            'authors',
            'topics'));
    }

}
