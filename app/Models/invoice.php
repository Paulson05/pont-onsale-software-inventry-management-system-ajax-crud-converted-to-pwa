<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\invoice
 *
 * @property int $id
 * @property string|null $invoice_no
 * @property string|null $date
 * @property string|null $description
 * @property int $status 0=pending, 1=Approved
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\invioceDetail[] $invoicedetails
 * @property-read int|null $invoicedetails_count
 * @property-read \App\Models\payment $payment
 * @property-read \App\Models\Supplier $supplier
 * @method static \Illuminate\Database\Eloquent\Builder|invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invoice whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'invoice';

    public function payment(){
        return $this->belongsTo(payment::class, 'id', 'invoice_id');
    }
    public function invoicedetails(){
        return $this->hasMany(invioceDetail::class, 'invoice_id', 'id' );
    }


    public function supplier(){
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }

}
