<?php
/**
 * RazorPaymentTransactionLog class
 * @category    Model
 * @author      ThinkPace
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class contains candidate stream year
 * @category     Model
 * @author       ThinkPace
 */
class RazorPaymentTransactionLog extends Model 
{
    use SoftDeletes;
    /**
     * The connection name for the model.
     *
     * @var string
     */

    /**
     * Table name
     * @var string
     */
 

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'authorised_rec_date', 'capture_rec_date','settlement_date'];

  /**
     * Fillable fields
     * @var array
     */
    // protected $fillable = ['candidate_appearance_exam_id','candidate_stream_id','candidate_stream_year_id','candidate_subject'];
    

}