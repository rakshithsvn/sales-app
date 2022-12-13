<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentMenu extends Model {

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
     protected $guarded  = ['id', 'created_at', 'updated_at'];

     use SoftDeletes;

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return request()->segment(1) === 'admin' ? 'id' : 'slug';
	}

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}

	public function submenus()
	{
		return $this->hasMany(SubMenu::class,'parent_menu_id','id')->where('display_sub_menu','=','Y')->orderBy('hierarchy','ASC');
	}
}
