<?php

namespace App\Http\Controllers;

use App\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MultimediaController extends Controller
{
    /**
     * MultimediaController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*var_dump($request->file);
        $validator = $request->validate([
            'file' => 'required',
            'file.*' => 'mimetypes:
                image/jpeg,
                image/jpg,
                image/png,
                video/mov,
                video/mp4,
                video/avi,
                video/mkv,
                audio/mpeg,
                application/pdf,
                application/msword,
                application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                application/vnd.ms-powerpoint,
                application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ]);*/

        if ($request->has('file')) {
            $array = array();
            $publicationId = $request->get('publicationId');
            foreach ($request->file('file') as $file) {
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
                    'publication_id' => $publicationId
                ]);
                $multimedia->save();
                array_push($array, $file->getClientOriginalName());
            }
            return response()->json(['message' => 'Your file was uploaded correctly.', 'file' => $array]);
        } else {
            return response()->json(['message' => 'Your request content no file.']);
        }

    }


    public function destroy($id)
    {
        $multimedia = Multimedia::find($id);
        Storage::disk('public')->delete($multimedia->url);
        $multimedia->delete();
        return redirect()->back()->with('status', 'Success! The file you have selected has been deleted' );
    }


}
