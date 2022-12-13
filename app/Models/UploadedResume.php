<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;


class UploadedResume extends Model {

    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $guarded  = ['id', 'created_at', 'updated_at'];

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return request()->segment(1) === 'admin' ? 'id' : 'slug';
	}

    protected $dates = ['deleted_at'];

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function careers()
	{
		return $this->hasOne('App\Models\Career', 'id', 'designation_id');
	}
    public function childmenus()
    {
        return $this->hasMany(ChildMenu::class,'sub_menu_id','id')->where('display_child_menu','=','Y');
    }

     public function parentmenus()
    {
        return $this->belongsToMany(ParentMenu::class);
    }

    public function childMenu()
    {
        return $this->belongsToMany(ChildMenu::class);
    }

    public function mainMenu()
    {
        return $this->belongsTo('App\Models\ParentMenu', 'parent_menu_id', 'id');
    }


}
