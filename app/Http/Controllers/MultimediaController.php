<?php

namespace App\Http\Controllers;

use App\Multimedia;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            'file' => 'required',
            'file.*' => 'file|mimetypes:image/jpeg,image/jpg,image/png,video/mpeg,video/avi'
        ]);

        if($request->has('file')){
            $array = array();
            $publicationId = $request->get('publicationId');
            foreach($request->file('file') as $file){
                $path = $file->store('images');
                $type = $file->getClientOriginalExtension();
                $multimedia = new Multimedia();
                $multimedia->fill([
                   'url' => $path,
                   'type' => $type,
                   'publication_id' => $publicationId
                ]);
                $multimedia->save();
                array_push($array , $file->getClientOriginalName());
            }
            return response()->json(['message' => 'Your file was uploaded correctly.' , 'file' => $array]);
        }else{
            return response()->json(['message' => 'Your request content no file.']);
        }

    }



}
