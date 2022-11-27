<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductTax;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = [
        "Name",
        "Price",
        "Quantity",
        "Discount",
        "DiscountAmount",
        "ValueDifference",
        "ItemDiscount",
    ];

    public function taxes () {
        return $this->hasMany(ProductTax::class, 'product_id');
    }
}
