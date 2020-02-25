<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Article;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Http\Resources\SuggestionResource;
use App\Photo;
use App\Post;
use App\Adviser;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Suggestion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:add', ['only' => ['addPhotosForm']]);
    }

    public function addPhotosForm($id)
    {
        $item=User::find($id);
        return view('photo.addPhotos', compact('item'));
    }

    public function addPhotos(PhotoRequest $request,$id)
    {
        $user=User::find($id);
        $user->photo  = $request->file('file')?makePhotoTypeFile($request->file('file'),'profile'):$this->photo;
        $user->save();
        return back();
    }

    public function summernoteUploadPhoto(Request $request)
    {
        $base_url=Setting::where('key',"base_url")->first()->value;
        return $base_url."/".makePhotoTypeFile($request->file('file'),'summer_note_editor');
    }

    public function destroyPhoto($id)
    {
        $user=User::find($id);
        $user->photo=null;
        $user->save();
        return back();
    }
}
