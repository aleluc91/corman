<?php

namespace App\Http\Controllers;

use App\Author;
use App\Publication;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($value)
    {
        $publications = Publication::with('authors', 'topics')
            ->whereHas('topics', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
            })->paginate(10);

        $users = User::with('author.publications.topics')
            ->whereHas('author.publications.topics', function ($query) use ($value) {
                $query->where('topics.name', 'like', '%' . $value . '%');
            })->get();


        $authors = collect([]);
        $topics = collect([]);

        if ($publications->isNotEmpty()) {
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
        }

        //$publications = $publications->paginate(10);
        return view('search.index', compact(
            'publications',
            'users',
            'authors',
            'topics',
            'value'
        ));
    }

    public function indexUsers($value)
    {
        $users = User::with('author.publications.topics')
            ->whereHas('author.publications.topics', function ($query) use ($value) {
                $query->where('topics.name', 'like', '%' . $value . '%');
            })->paginate(10);


        return view('search.index_users', compact('users'));
    }

    public function indexPublications($value)
    {
        $publications = Publication::with('authors', 'topics')
            ->whereHas('topics', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
            })->paginate(10);

        $authors = collect([]);
        $topics = collect([]);

        if ($publications->isNotEmpty()) {
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
        }

        return view('search.index_publications', compact(
            'publications',
            'authors',
            'topics'
        ));
    }

    public function autoCompleteTopics($query)
    {
        $topics = Topic::select('name')->where('name', 'like', '%' . $query . '%')->get();
        return response()->json($topics);
    }

}
