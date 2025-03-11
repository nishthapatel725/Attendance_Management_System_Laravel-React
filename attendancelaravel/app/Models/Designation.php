<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'designations';
    protected $primaryKey = 'id'; 

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'designation_id');
    }
}
