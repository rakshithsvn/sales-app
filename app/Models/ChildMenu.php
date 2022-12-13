<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildMenu extends Model {

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $guarded = ['id', 'created_at', 'updated_at', 'q'];

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

	public function subMenu()
    {
        return $this->belongsTo('App\Models\SubMenu', 'sub_menu_id', 'id');
    }

    public function subchildmenus()
    {
        return $this->hasMany(SubChildMenu::class,'child_menu_id','id')->where('display_child_menu','=','Y')->orderBy('hierarchy','ASC');;
    }

    public function subChildMenu()
    {
        return $this->belongsToMany(SubChildMenu::class);
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'id', 'child_menu_id');
    }
}
