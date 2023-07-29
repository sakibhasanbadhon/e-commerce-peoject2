<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerreview extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'name',
        'review',
        'rating',
        'status'
    ];
}
