<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{


    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get($id){
        $topics = Topic::whereHas('publications' , function($query) use($id){
            $query->where('publications.id' , "=" , $id);
        })->get();
        if(!empty($topics))
            return response()->json(array('status' => 200 , 'topics' => $topics));
        else
            return response()->json(array('status' => 500 , 'errors' => 'This publication has no topic.'));
    }

    public function index(){
        $topics = Topic::all();
        if(!empty($topics))
            return response()->json(array('status' => 200 , 'topics' => $topics));
        else
            return response()->json(array('status' => 500 , 'errors' => 'This publication has no topic.'));
    }
    
}
