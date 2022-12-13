<?php
/**
 * RazorPaymentCredentials class
 * @category    Model
 * @author      ThinkPace
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class contains candidate exam board list
 * @category     Model
 * @author       ThinkPace
 */
class RazorPaymentCredential extends Model 
{
    use SoftDeletes;
    /**
     * The connection name for the model.
     *
     * @var string
     */
    //protected $connection = 'clientDB';

    /**
     * Table name
     * @var string
     */
    protected $table ='razor_payment_credentials';
    

  /**
     * Fillable fields
     * @var array
     */
    // protected $fillable = ['exam_name'];

}
