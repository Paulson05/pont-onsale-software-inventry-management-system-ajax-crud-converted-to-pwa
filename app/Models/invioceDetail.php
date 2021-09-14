<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\invioceDetail
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $category_id
 * @property int $products_id
 * @property string|null $date
 * @property float $selling_qty
 * @property float $unit_price
 * @property float $selling_price
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereSellingQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|invioceDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class invioceDetail extends Model
{
    protected $table = 'invoice_details';
    protected $guarded = [];
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'products_id');
    }
}
