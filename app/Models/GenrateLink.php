<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenrateLink extends Model
{
    protected $table="genrate_link";
    protected $fillable = ['school_id','date_id','link'];



    public function exam_date(){
        return $this->belongsTo(ExamShedule::class);
    }

}
