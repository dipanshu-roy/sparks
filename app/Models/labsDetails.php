<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class labsDetails extends Model
{
    protected $table="labs_details";
    protected $fillable = ['registration_id','labs_name','computer_qty'];
}
