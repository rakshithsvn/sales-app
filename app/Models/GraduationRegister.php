<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class GraduationRegister extends Model {

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $guarded  = ['id', 'created_at', 'updated_at','q'];

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

    protected $dates = ['deleted_at','date','dob'];

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function posts()
	{
		return $this->belongsToMany(Post::class);
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

     public function faculty()
    {
        return $this->belongsTo('App\Models\FacultyDetail', 'faculty_id', 'id');
    }

     public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    public function getFullNameAttribute($value)
    {
       return ucfirst($this->attributes['first_name']) . ' ' . ucfirst($this->attributes['last_name']);
    }
}
