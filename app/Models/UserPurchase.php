<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserPurchase extends Model
{
    use HasFactory, IngoingTrait, Notifiable;

   protected $dispatchesEvents = [
      
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id', 'created_at', 'updated_at', 'q'];

    public function user()
    {
        return $this->belongsTo('App\Models\EventUser', 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer', 'dealer_id', 'id');
    }

}
