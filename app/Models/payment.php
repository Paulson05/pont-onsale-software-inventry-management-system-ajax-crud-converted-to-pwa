<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\payment
 *
 * @property int $id
 * @property int $invoice_id
 * @property string $customers_id
 * @property string|null $paid_status
 * @property float|null $paid_amount
 * @property float|null $due_amount
 * @property float|null $total_amount
 * @property float|null $discount_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereCustomersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereDueAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment wherePaidStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class payment extends Model
{
    protected $guarded = [];
    protected $table = 'payments';
    use HasFactory;
    public function customer(){
        return $this->belongsTo(Customer::class, 'customers_id', 'id');
    }
    public function invoice(){
        return $this->belongsTo(invoice::class, 'invoice_id', 'id');
    }
}
