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

class Testimonial extends Model
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
    protected $dates = ['deleted_at'];



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded  = ['id', 'created_at', 'updated_at', 'q'];

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

    

    public function getId()
    {
        return Hashids::encode($this->id);
    }


    
}
