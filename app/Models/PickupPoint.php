<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;

    protected $fillable =[
        'pickup_point_name',
        'address',
        'phone',
        'another_phone'
    ];
}
