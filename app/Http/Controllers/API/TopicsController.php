<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TopicResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TopicsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userTopic = \App\User::with('author.publications.topics')->find(Auth::user()->id);
        $topicsCollection = collect([]);
        $userTopic->author->publications->each(function($item , $key) use($topicsCollection){
            $item->topics->map(function($item , $key) use($topicsCollection){
               if(!$topicsCollection->contains($item))
                   $topicsCollection->push($item);
            });
        });
        if($topicsCollection->isNotEmpty())
            return TopicResource::collection($topicsCollection);
        else
            return json(['error' => 'No topics']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
