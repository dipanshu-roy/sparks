<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schoolenrolment extends Model
{
    protected $table = "enrollment_details";
    
    protected $fillable = [
        'registration_id',
        'total_enrollment',
        'class_1_to_8_enroll',
        'total_com_labs',
    ];
}
