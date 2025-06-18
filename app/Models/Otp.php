<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    
    protected $table="send_otp";
    protected $fillable = ['registration_id', 'otp', 'status', 'validate','type','source'];



}
