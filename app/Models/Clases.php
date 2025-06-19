<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $table = 'class'; // explicitly define table
    protected $fillable = ['name']; // allow mass assignment
}
