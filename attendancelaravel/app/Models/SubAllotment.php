<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAllotment extends Model
{
    use HasFactory;
    protected $table = 'sub_allotments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'sem_id',
        'sub_id',
        't_id',
        'academic_year',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'sem_id', 'sem_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'sub_id', 'sub_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 't_id', 'id');
    }

}
