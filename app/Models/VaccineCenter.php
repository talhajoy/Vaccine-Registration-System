<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'daily_capacity',
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

    public function getAvailableSlotsForDate($date)
    {
        $scheduled = $this->registrations()
            ->where('scheduled_date', $date)
            ->where('status', 'scheduled')
            ->count();

        return $this->daily_capacity - $scheduled;
    }
}
