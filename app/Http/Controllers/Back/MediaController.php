<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\MediaRequest,
    Models\MediaAlbum,
    Models\MediaAlbumContent,
    Models\Career,
    Models\ParentMenu,
    Models\Post
};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MediaController extends Controller
{
    protected $documentPath;
    protected $storage;

    /**
     * instance of the class
     */
    public function __construct()
    {
        $this->storage = Storage::disk('public');

        Storage::disk('public')->makeDirectory('dealers-image');

        $this->documentPath = public_path('storage/dealers-image');
      
    }
    /**
     * Display a listing of the albums.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = ($request['search'])?$request['search']:null;
        $albums = MediaAlbum::where('category', 'TOUR')->orderBy('id', 'desc')->paginate(10);
         if(isset($search))
        {
            $albums =  MediaAlbum::where('title', 'like', "%".$search."%")->paginate(10);
        }
        $links = $albums->appends ($request->all())->links ('back.pagination');
        // Ajax response
        if ($request->ajax ()) {

            return response ()->json ([
                'table' => view ("back.media.table", ['albums' => $albums])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }
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
        $request->merge(['user_id' => auth()->id()]);
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
        if(is_null($album->id)){
            $album = MediaAlbum::where('category','PLACEMENTS')->first();
            if(empty($album)){
                $album = new MediaAlbum();
                $album->title = "PLACEMENTS";
                $album->slug = 'placements';
                $album->category = 'PLACEMENTS';
                $album->active = '1';
                $album->user_id = auth()->id();
                $album->save();
            }
        }
        $media_photos = MediaAlbumContent::where('media_album_id',$album->id)->first();

        return view('back.media-photos.create', compact('album', 'media_photos'));
    }

   public function imageUpload($album_id){
       $album = MediaAlbum::find($album_id);
        $allowed = array('png', 'jpg', 'jpeg');
            if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
                $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if(!in_array(strtolower($extension), $allowed)){
                    echo '{"status":"error"}';
                    exit;
                }
                $temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = $temp[0].'_'.round(microtime(true)) . '.' . end($temp);
                $imgName=$temp[0].'_'.round(microtime(true));
                $filepath = "storage/files/" . $album->slug;
               
                if (!is_dir($filepath)) {
                    mkdir($filepath);
                }
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath . "/" . $newfilename)){
                        $photo = MediaAlbumContent::where('media_album_id',$album_id)->first();
                        if(empty($photo)){
                            $photo = new MediaAlbumContent();
                        }
                        $photo->media_album_id=$album_id;
                        $photo->filename = $photo->filename . ',/' . $filepath . "/" . $newfilename;
                        $photo->user_id = auth()->id();
                        $photo->save(); 
                        // echo $newfilename;
                        exit;
                    }
            }
            echo '{"status":"error"}';
            exit;
    }

    public function removePhoto(Request $request){
        $album_contents = MediaAlbumContent::find($request->id);
        $updates_file_names = str_replace($request->filename , '', $album_contents->filename);
        $album_contents->filename = $updates_file_names;
        $album_contents->save();
        return $updates_file_names;
    }

    public function uploadVideo(){
        $album = MediaALbum::where('category','VIDEO')->first();
        if(empty($album)){
            $album = new MediaAlbum();
            $album->title = "VIDEO";
            $album->slug = 'video';
            $album->category = 'VIDEO';
            $album->active = '1';
            $album->user_id = auth()->id();
            $album->save();
        }
        $media_videos = MediaAlbumContent::where('media_album_id',$album->id)->get();
        return view('back.media-videos.create', compact('album', 'media_videos'));
    }

    public function storeVideo(Request $request){
        // dd($request->all());
        foreach($request->description as $key => $link){
            if(!empty($link)){
                if($request->content_id[$key]!=0){
                    $video_file = MediaAlbumContent::find($request->content_id[$key]);
                    $video_file->media_album_id = $request->album_id;
                    $video_file->filename = $link;
                    $video_file->user_id = auth()->id();
                    $video_file->save();
                }else{
                    $new_video_file = new MediaAlbumContent();
                    $new_video_file->media_album_id = $request->album_id;
                    $new_video_file->filename = $link;
                    $new_video_file->user_id = auth()->id();
                    $new_video_file->save();
                }
            }
        }
        return 'success';
    }

    public function removeVideo(Request $request){
        $album_contents = MediaAlbumContent::find($request->id);
        $album_contents->delete();
        return ['rowCount' => $request->row_count];
    }
    
}
