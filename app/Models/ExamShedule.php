<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamShedule extends Model
{
    protected $table = "exam_shedule";
    protected $fillable = ['shedule_date','class_id', 'subject_id', 'exam_end_date','exam_fee','discount'];
}
