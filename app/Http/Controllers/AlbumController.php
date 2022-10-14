<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorAlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums =Album::all();
        return view('album.index',[
            "albums" => $albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorAlbumRequest $request)
    {

        Album::create($request->validated());
        session() -> flash('success','Created Successfully');
        return redirect(route('album.index'));    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album =Album::with('photos')->find($id);
        return view('photos.index',[
            'album' => $album
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $albums =Album::find($id);
        return view('album.create',[
            'albums' => $albums
        ]);
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
        $albums= Album::find($id);
        $albums ->update([
            'name' => $request->name
        ]);
        session() -> flash('success','Updated Successfully');
        return redirect(route('album.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photos = Album::find($id);
        $photos -> delete();
        return redirect(route('album.index'));
    }


    public function action(Request $request)
    {

        $album = Album::with('photos')->find($request->folder_id);
        if($request->submit === 'delete'){
            $album->photos->map(
                function($photo){
                    unlink('storage/'.$photo->photo);
                    $photo -> delete();
                });
            $album -> delete();
        }elseif($request->submit === 'update'){
            $album->photos->map(fn($i) =>$i->update([
                'album_id' =>$request->album_id,
            ]));
        }
        return redirect(route('album.index'));
    }
}
