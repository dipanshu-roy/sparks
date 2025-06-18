<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolDetails extends Model
{
    protected $table = "school_details";
    protected $fillable = [
        'registration_id',
        'board_id',
        'school_name',
        'state_id',
        'district_id',
        'city_id',
        'pin'
    ];
}
