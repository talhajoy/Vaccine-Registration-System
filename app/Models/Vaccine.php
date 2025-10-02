<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer',
        'description',
        'doses_required',
        'days_between_doses',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function vaccinationRecords()
    {
        return $this->hasMany(VaccinationRecord::class);
    }
}
