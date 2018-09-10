<?php

namespace App\Http\Controllers;

use App\Author;
use App\Multimedia;
use App\Publication;
use App\Topic;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $authorsDblpUrl = collect([]);
        $authorsImage = collect([]);
        $publication->authors->map(function ($item, $key) use ($authors, $authorsDblpUrl, $authorsImage) {
            $user = $item->user;
            if (!empty($user)) {
                $authorsImage->push($user->avatar);
                $authors->push(['author' => $item, 'active' => true]);
            } else {
                $authorsImage->push("avatar.jpg");
                $authors->push(['author' => $item, 'active' => false]);
            }
            $authorsDblpUrl->push($item->dblp_url);
        });

        $publicationImages = collect([]);
        $publicationVideos = collect([]);
        $publicationAudios = collect([]);
        $publicationPresentation = collect([]);

        $publication->multimedias->map(function ($item, $key) use ($publicationImages, $publicationVideos, $publicationAudios, $publicationPresentation) {
            if (($item->type === 'image/jpg') or ($item->type === 'image/jpeg') or ($item->type === 'image/png')) {
                $publicationImages->push($item);
            } else if (($item->type === 'video/mp4') or ($item->type === 'video/mkv')) {
                $publicationVideos->push($item);
            } else if ($item->type === 'audio/mpeg')
                $publicationAudios->push($item);
            else {
                $publicationPresentation->push($item);
            }
        });

        return view('publications.show', compact(
            'publication',
            'authors',
            'authorsDblpUrl',
            'authorsImage',
            'topics',
            'publicationImages',
            'publicationVideos',
            'publicationAudios',
            'publicationPresentation'
        ));
    }

    public function create()
    {
        $allTopics = Topic::all();
        return view('publications.create', compact('allTopics'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|min:2|max:200',
            'venue' => 'string|min:2|max:200',
            'publisher' => 'nullable|string|min:2|max:200',
            'volume' => 'nullable|numeric',
            'pages' => 'nullable|string',
            'year' => 'required|digits:4',
            'ee' => 'nullable|url',
            'description' => 'nullable|min:2|max:1000',
        ]);

        $publication = new Publication();
        $publication->type = $request->get('type');
        $publication->title = $request->get('title');
        $publication->venue = $request->get('venue');
        $publication->publisher = $request->get('publisher');
        $publication->volume = $request->get('volume');
        $publication->number = $request->get('number');
        $publication->pages = $request->get('pages');
        $publication->year = $request->get('year');
        $publication->ee = $request->get('ee');
        $publication->description = $request->get('description');
        $publication->save();
        $publication->authors()->attach($request->get('authorId'));

        if ($request->has('topics')) {
            $topicsId = collect([]);
            foreach ($request->get('topics') as $topic) {
                try {
                    $retriviedTopic = Topic::where('name', $topic)->firstOrFail();
                    $topicsId->push($retriviedTopic->id);
                } catch (ModelNotFoundException $e) {
                    $newTopic = new Topic();
                    $newTopic->name = $topic;
                    $newTopic->save();
                    $topicsId->push($newTopic->id);
                }
            }
            if ($topicsId->isNotEmpty())
                $publication->topics()->sync($topicsId);
        }

        if ($request->has('authors')) {
            $authorsId = collect([]);
            foreach ($request->get('authors') as $id) {
                $user = User::find($id);
                $authorsId->push($user->author->id);
            }
            $publication->authors()->attach($authorsId);
        }

        if ($request->hasFile('files')) {
            foreach($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $type = $file->getClientOriginalExtension();
                if (($type === 'jpg') or ($type === 'jpeg') or ($type === 'png')) {
                    $type = 'image/' . $type;
                    $path = $file->store(
                        'publications_image', 'public'
                    );
                } else if (($type === 'mkv') or ($type === 'mp4') or ($type === 'avi')) {
                    $type = 'video/' . $type;
                    $path = $file->store(
                        'publications_video', 'public'
                    );
                } else if (($type === 'mp3')) {
                    $type = 'audio/mpeg';
                    $path = $file->store(
                        'publications_audio', 'public'
                    );
                } else {
                    $path = $file->store(
                        'publications_other', 'public'
                    );
                }

                $multimedia = new Multimedia();
                $multimedia->fill([
                    'name' => $name,
                    'url' => $path,
                    'type' => $type,
                    'publication_id' => $publication->id
                ]);
                $multimedia->save();
            }
        }
        return redirect()->route('home')->with('status' , "The publication has been created!");
    }


    public function edit($id)
    {
        $publication = Publication::with(array('authors', 'topics', 'multimedias'))->find($id);
        $publicationMultimedias = Multimedia::where("publication_id", $id)
            ->whereNotIn('type', ['pdf', 'doc', 'docx', 'ppt', 'pptx'])
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
        $publication->multimedias->map(function ($item, $key) use ($publicationImages, $publicationVideos, $publicationAudios, $publicationPresentation) {
            if (($item->type === 'image/jpg') or ($item->type === 'image/jpeg') or ($item->type === 'image/png')) {
                $publicationImages->push($item);
            } else if (($item->type === 'video/mp4') or ($item->type === 'video/mkv')) {
                $publicationVideos->push($item);
            } else if ($item->type === 'audio/mpeg')
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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|min:2|max:200',
            'venue' => 'string|min:2|max:200',
            'publisher' => 'nullable|string|min:2|max:200',
            'volume' => 'nullable|numeric',
            'pages' => 'nullable|string',
            'year' => 'required|digits:4',
            'ee' => 'nullable|url',
            'description' => 'nullable|min:2|max:1000',
        ]);

        $publication = Publication::find($id);
        $publication->type = $request->get('type');
        $publication->title = $request->get('title');
        $publication->venue = $request->get('venue');
        $publication->publisher = $request->get('publisher');
        $publication->volume = $request->get('volume');
        $publication->number = $request->get('number');
        $publication->pages = $request->get('pages');
        $publication->year = $request->get('year');
        $publication->ee = $request->get('ee');
        $publication->description = $request->get('description');
        $publication->save();
        $publication->authors()->attach($request->get('authorId'));

        if ($request->has('topics')) {
            $topicsId = array();
            foreach ($request->get('topics') as $topic) {
                try {
                    $retriviedTopic = Topic::where('name', $topic)->firstOrFail();
                    array_push($topicsId , $retriviedTopic->id);
                } catch (ModelNotFoundException $e) {
                    $newTopic = new Topic();
                    $newTopic->name = $topic;
                    $newTopic->save();
                    array_push($topicsId , $newTopic->id);

                }
            }
            if (!empty($topicsId))
                $publication->topics()->sync($topicsId);
        }
        return redirect()->route('publications.show', ['id' => $publication->id])->with('status', 'Success! The publication data has been updated.');
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
            $item->authors->map(function ($item, $key) use ($localAuthors, $localAuthorsActive) {
                $localAuthors->push($item);
                if ($item->user()->exists())
                    $localAuthorsActive->push(true);
                else
                    $localAuthorsActive->push(false);
            });
            $authors->push(['authors' => $localAuthors, 'active' => $localAuthorsActive]);
            $topics->push($item->topics);
        });
        $publications = $publications->paginate(10);

        $user = User::with('groups')->find(Auth::user()->id);
        $groups = collect([]);
        if($user->groups->isNotEmpty())
            $groups = $user->groups;

        return view('publications.filter', compact(
            'publications',
            'authors',
            'topics',
            'groups'
        ));
    }

}
