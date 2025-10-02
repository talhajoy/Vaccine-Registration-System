<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_center_id',
        'vaccine_id',
        'preferred_date',
        'scheduled_date',
        'scheduled_time',
        'status',
        'dose_number',
        'health_conditions',
        'notes'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function vaccinationRecord()
    {
        return $this->hasOne(VaccinationRecord::class);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'scheduled' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'scheduled']) &&
            (!$this->scheduled_date || $this->scheduled_date->isFuture());
    }
}
