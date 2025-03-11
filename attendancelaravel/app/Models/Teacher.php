<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ;
    protected $table = 'teachers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'qualification',
        'designation_id',
        'date_of_joining',
        'contact',
        'email',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    // protected $hidden = [
    //     'password',

    // ];

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'password' => 'hashed',
    //     ];
    // }
}
