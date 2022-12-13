<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ {
    ModelCreated,
    PostUpdated
};
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids;

class Post extends Model
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

    protected $dates = ['deleted_at','event_date','event_to_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at', 'tab_title', 'tab_image', 'tab_body', 'q'];

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

    public function subchildmenus()
    {
        return $this->belongsToMany(SubChildMenu::class);
    }

    public function mainMenu()
    {
        return $this->belongsTo('App\Models\ParentMenu', 'parent_menu_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

     public function subMenu()
    {
        return $this->belongsTo('App\Models\SubMenu', 'sub_menu_id', 'id');
    }

     public function childMenu()
    {
        return $this->belongsTo('App\Models\ChildMenu', 'child_menu_id', 'id');
    }

    public function subChildMenu()
    {
        return $this->belongsTo('App\Models\SubChildMenu', 'sub_child_menu_id', 'id');
    }



    public function tabContent()
    {
        return $this->belongsTo('App\Models\TabSection', 'post_id', 'id');
    }


     public function linkFaculty()
    {
        return $this->hasMany('App\Models\LinkFaculty', 'post_id', 'id');
    }

    public function getId()
    {
        return Hashids::encode($this->id);
    }

}
