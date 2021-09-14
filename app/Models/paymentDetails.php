<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\paymentDetails
 *
 * @property int $id
 * @property int $invoice_id
 * @property float|null $current_paid_amount
 * @property string|null $date
 * @property int|null $update_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereCurrentPaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereUpdateBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|paymentDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class paymentDetails extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

}
