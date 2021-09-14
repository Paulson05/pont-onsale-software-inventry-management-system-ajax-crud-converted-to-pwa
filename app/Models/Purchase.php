<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $suppliers_id
 * @property int $category_id
 * @property int $products_id
 * @property string $purchase_no
 * @property string $date
 * @property string|null $description
 * @property float $buying_qty
 * @property float $unit_price
 * @property float $buying_price
 * @property int $status 0=pending,1=Approved
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Supplier $supplier
 * @property-read \App\Models\Unit $unit
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereBuyingQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase wherePurchaseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereSuppliersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $guarded = [];

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'products_id');
    }
}
