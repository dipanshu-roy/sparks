<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    protected $table = "subject";
    protected $fillable = ['class_id','name'];

}
