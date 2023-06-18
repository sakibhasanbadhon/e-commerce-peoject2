<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpMail extends Model
{
    use HasFactory;

    protected $fillable =[
        'mailer',
        'host',
        'port',
        'user_name',
        'password'
    ];

}
