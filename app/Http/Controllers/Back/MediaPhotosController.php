<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\MediaRequest,
    Models\MediaAlbum,
    Models\MediaAlbumContent
};

class MediaPhotosController extends Controller
{
    /**
     * Display a listing of the albums.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albums = MediaAlbum::oldest('title')->get();
        return view('back.media.index', compact ('albums'));
    }

    /**
     * Show the form for creating a new album.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.media.create');
    }

    /**
     * Store a newly created album in storage.
     *
     * @param  \App\Http\Requests\MediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        $request->merge(['active' => $request->has('active')]);
        MediaALbum::create($request->all());
        return redirect(route('albums.index'))->with('category-ok', __('The album has been successfully created'));
    }

    /**
     * Show the form for editing the specified album.
     *
     * @param  \App\Models\MediaAlbum  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaAlbum $media_album,$slug)
    {
        $media_album = MediaAlbum::find($slug);
        return view('back.media.edit', compact ('media_album'));
    }

    /**
     * Update the specified album in storage.
     *
     * @param  \App\Http\Requests\MediaRequest  $request
     * @param  \App\Models\MediaAlbum  $album
     * @return \Illuminate\Http\Response
     */
    public function update(MediaRequest $request, MediaAlbum $album)
    {
        $request->merge(['active' => $request->has('active')]);
        $album->update($request->all());

        return redirect(route('albums.index'))->with('category-ok', __('The album has been successfully updated'));
    }

     /**
     * Update "active" field for album.
     *
     * @param  \App\Models\MediaAlbum $album
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(MediaAlbum $album, $status = false)
    {
        $album->active = $status;
        $album->save();

        return response ()->json ();
    }

    /**
     * Remove the specified album from storage.
     *
     * @param  \App\Models\MediaAlbum  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaAlbum $album)
    {
        $album->delete ();
        return response ()->json ();
    }

    /**
     * Update "active" field for album.
     *
     * @param  \App\Models\MediaAlbum $album
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function uploadPhoto(MediaAlbum $album)
    {
        $photos = MediaAlbumContent::where('media_album_id',$album->id)->get();
        return $photos;
        return view('back.media-photos.create', compact('album', 'photos'));
    }
    
}
