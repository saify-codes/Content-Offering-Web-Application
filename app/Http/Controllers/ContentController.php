<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user()->id;
        $route = $request->route()->uri;
        switch ($route) {
            case 'create/video':
                $videos = Content::where([['user_id', $user], ['type', 1]])->get();
                return view('create')->with('videos', $videos);

            case 'create/image':
                $images = Content::where([['user_id', $user], ['type', 2]])->get();
                return view('create')->with('images', $images);

            case 'create/document':
                $documents = Content::where([['user_id', $user], ['type', 3]])->get();
                return view('create')->with('documents', $documents);
            default:
                print "default";
        }
    }
    
    public function serve($id){
        
    }
}
