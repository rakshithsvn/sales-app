<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Activitylog\Traits\LogsActivity;


class MediaAlbumContent extends Model
{
    // use IngoingTrait,LogsActivity;
    
    use SoftDeletes; 

    protected $dates = ['created_at','updated_at','deleted_at'];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'user_id'
    ];

    protected static $logAttributes = ['filename', 'user_id'];

    public function MediaAlbum()
    {
        return $this->belongsTo('App\Models\MediaAlbum', 'media_album_id');
    }
}
