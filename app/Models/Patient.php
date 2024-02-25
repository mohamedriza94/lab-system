<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'nic',
        'age',
        'dateOfBirth',
        'password',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
