<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'contact',
        'email',
        'password',
        'gr_no',
        'enrollment_no',
        'course_id',
        'sem_id',
    ];

    // protected $hidden = [
    //     'password',
    // ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'sem_id');
    }

}
