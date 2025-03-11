<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApprove extends Model
{
    use HasFactory;

     protected $primaryKey = 's_id';

     public $incrementing = true;

     protected $fillable = [
         's_fname', 's_mname', 's_lname', 'gr_no', 'en_no', 'course_id', 'sem_id', 'approval_status'
     ];


     public $timestamps = true;

     public function course()
     {
         return $this->belongsTo(Course::class, 'course_id', 'course_id');
     }

     public function semester()
     {
         return $this->belongsTo(Semester::class, 'sem_id', 'sem_id');
     }
}
