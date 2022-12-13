<?php
/**
 * RazorPaymentMissingSettlement class
 * @category    Model
 * @author      ThinkPace
 */
namespace App;

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class contains Razor Payment Missing Settlement
 * @category     Model
 * @author       ThinkPace
 */
class RazorPaymentMissingSettlement extends Model 
{
    use SoftDeletes;
    /**
     * The connection name for the model.
     *
     * @var string
     */

protected $table = 'razor_payment_missing_settlement';
    protected $dates = ['payment_captured_date','created_at', 'updated_at', 'deleted_at'];

  /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['payment_id','fees','fee_type','payment_method'];
}