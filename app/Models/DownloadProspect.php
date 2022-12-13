<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DownloadProspect extends Model
{
    use SoftDeletes;

    use IngoingTrait,LogsActivity;

    protected $dates = ['deleted_at'];

    protected $guarded  = ['id', 'created_at', 'updated_at','q'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function postId()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
