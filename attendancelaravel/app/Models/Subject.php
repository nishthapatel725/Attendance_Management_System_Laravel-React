<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Semester;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'sub_id';


    protected $fillable = [
        'course_id',
        'sem_id',
        'sub_code',
        'sub_name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

   
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'sem_id', 'sem_id');
    }

}
