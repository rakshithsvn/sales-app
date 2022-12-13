<?php
/**
 * RazorPaymentSettlementReconciliation class
 * @category    Model
 * @author      ATC
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids;
/**
 * This class contains candidate stream year
 * @category     Model
 * @author       ThinkPace
 */
class RazorPaymentSettlementReconciliation extends Model 
{
    use SoftDeletes;
    /**
     * The connection name for the model.
     *
     * @var string
     */
protected $table = 'razor_payment_settlement_reconciliation';
    /**
     * Table name
     * @var string
     */

    protected $dates = ['reconciled_date','created_at', 'updated_at', 'deleted_at'];

     protected $hashids;
  /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['reconciled_date','file_path','total_record','matched_record','mismatch_record'];

    public function getId()
    {
        return Hashids::encode($this->id);
    }
}