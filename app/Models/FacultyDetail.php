<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ {
    ModelCreated,
    PostUpdated
};
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyDetail extends Model
{
    use IngoingTrait,LogsActivity,SoftDeletes;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
        'updated' => PostUpdated::class,
    ];
        protected $dates = ['deleted_at','from_date','to_date'];



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded  = ['id', 'created_at', 'updated_at', 'tab_title', 'tab_body', 'q'];

    public function getPageSlug() {
    return 'faculty';
}

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function parentComments()
    {
        return $this->validComments()->whereParentId(null);
    }

    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

     public function submenus()
    {
        return $this->belongsToMany(SubMenu::class);
    }

    public function parentmenus()
    {
        return $this->belongsToMany(ParentMenu::class);
    }

    public function childmenus()
    {
        return $this->belongsToMany(ChildMenu::class);
    }

    public function mainMenu()
    {
        return $this->belongsTo('App\Models\ParentMenu', 'parent_menu_id', 'id');
    }

     public function subMenu()
    {
        return $this->belongsTo('App\Models\SubMenu', 'sub_menu_id', 'id');
    }

    public function tabContents()
    {
        return $this->belongsTo('App\Models\PostTab', 'post_tab_id', 'id');
    }

    public function postContents()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

      public function getFullNameAttribute($value)
    {
       return ucfirst($this->attributes['name']) . ' ' . ucfirst($this->attributes['last_name']);
    }
    
}
