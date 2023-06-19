<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'name',
        'code',
        'unit',
        'tags',
        'video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'warehouse',
        'description',
        'status',
        'thumbnail',
        'images',
        'featured',
        'today_deal',
        'flash_deal_id',
        'cash_on_delivery',
        'admin_id',
    ];


}
