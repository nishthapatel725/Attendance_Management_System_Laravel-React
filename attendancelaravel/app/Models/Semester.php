<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';
    protected $primaryKey = 'sem_id';
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;
    // public function subject()
    // {
    //     return $this->hasMany(Subject::class, 'sem_id', 'sem_id');
    // }
    
}
