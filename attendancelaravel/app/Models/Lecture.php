<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = [
        'lec_date',
        'course_id',
        'sem_id',
        'sub_id',
        'lec_topic',
        'lec_method',
        'lec_no',
        'proxy_status',
        't_id'
    ];

    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class, 'sub_id', 'id');
    // }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'sub_id'); // Assuming 'sub_id' is the foreign key
    }
}
