<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=[
        'blog_category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'tag',
        'status'
    ];

    public function blogCategory() {
        return $this->belongsTo(Blog_category::class);
    }
}
