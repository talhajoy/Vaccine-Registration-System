<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'user_id',
        'vaccine_id',
        'vaccine_center_id',
        'vaccination_date',
        'vaccination_time',
        'batch_number',
        'dose_number',
        'administered_by',
        'side_effects',
        'next_dose_due'
    ];

    protected $casts = [
        'vaccination_date' => 'date',
        'vaccination_time' => 'datetime:H:i',
        'next_dose_due' => 'date',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
