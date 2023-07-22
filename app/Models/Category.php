<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['icon','category_name','category_slug','home_page'];


    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

}
