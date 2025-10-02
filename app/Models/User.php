<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'national_id',
        'address',
        'role',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function vaccinationRecords()
    {
        return $this->hasMany(VaccinationRecord::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth->age;
    }
}
