<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorPhotosRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{


    public function create($id)
    {

        return view('photos.create',[
            'album_id' => $id
        ]);
    }



    public function store(StorPhotosRequest $request)
    {
        Photo::create([
            'name' =>$request->name,
            'photo' =>$request->photo->store('photos','public'),
            'album_id' =>$request->album_id
        ]);
        session() -> flash('success','Post Created Successfully');
        return redirect(route('album.show',$request->album_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photos = Photo::find($id);
        $album_id = $photos->album_id;
        unlink('storage/'.$photos->photo);
        $photos -> delete();
        return redirect(route('album.show',$album_id));
    }
}
