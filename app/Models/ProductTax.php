<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTax extends Model
{
    use HasFactory;
    protected $table = 'products_taxes';
    public $timestamps = false;
    protected $fillable = [
        "product_id",
        "tax_id"
    ];
}
