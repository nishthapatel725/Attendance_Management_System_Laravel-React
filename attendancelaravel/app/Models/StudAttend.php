<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudAttend extends Model
{
    use HasFactory;

    protected $table = 'stud_attend';

    protected $fillable = [
        'lec_id',
        's_id',
        'p_flag',
    ];

    // Define relationships (optional)
    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lec_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 's_id');
    }
}
