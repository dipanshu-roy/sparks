<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headofschool extends Model
{
    protected $table = "head_of_school";
    protected $fillable = [
        'title_id',
        'first_name',
        'last_name',
        'second_name',
        'email',
        'mobile',
        'designation',
        'registration_id',
        'is_validate',
        'is_mobile_validates',
        'email_otp',
        'mobile_otp',
        
    ];
}

