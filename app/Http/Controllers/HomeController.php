<?php

namespace App\Http\Controllers;

use App\Dblp\DblpAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $publications = \App\Publication::with(['authors', 'topics'])->whereHas('authors', function ($query) {
            $query->where('dblp_url', '=', Auth::user()->dblp_url);
        });

        $authors = collect([]);
        $topics = collect([]);
        $singleType = collect([]);
        $singleTopic = collect([]);
        $singleYear = collect([]);

        if (!empty($publications)) {
            $publications->each(function ($item, $key) use ($authors, $topics, $singleTopic, $singleType, $singleYear) {
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
                if (!$singleType->contains($item->type))
                    $singleType->push($item->type);
                $item->topics->map(function ($item, $key) use ($singleTopic) {
                    if (!$singleTopic->contains($item))
                        $singleTopic->push($item);
                });
                if (!$singleYear->contains($item->year))
                    $singleYear->push($item->year);
            });

            $publications = $publications->paginate(10);
        }


        return view('home', compact(
            'publications',
            'authors',
            'topics',
            'singleType',
            'singleTopic',
            'singleYear'
        ));
    }

}
