<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genrateurl extends Model
{

    protected $table="generate_url";

    protected $fillable = [
        'registration_id',
        'school_url',
        'status',
    ];

}
