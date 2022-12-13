<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FacultyDetail;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids;

class FacultySchedule extends Model
{
    use IngoingTrait,LogsActivity,SoftDeletes;    
 
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['created_at','updated_at'];

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
	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}
   
    public function parentmenus()
    {
        return $this->belongsToMany(ParentMenu::class);
    }

    public function mainMenu()
    {
        return $this->belongsTo('App\Models\ParentMenu', 'parent_menu_id', 'id');
    }

    public function getId()
    {
        return Hashids::encode($this->id);
    }
   
}
