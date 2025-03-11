<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Subject;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'course_type',
        'course_sem',
    ];

    public $timestamps = true;
    // public function subject()
    // {
    //     return $this->hasMany(Subject::class, 'course_id', 'course_id');
    // }

}
