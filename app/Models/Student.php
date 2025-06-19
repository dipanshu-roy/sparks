<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'full_name',
        'father_name',
        'class',
        'section',
        'school_id',
        'mobile','email', 'middle_name', 'last_name', 'subject_id'
    ];
}
