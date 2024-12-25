<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orthodontic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function appoint()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function dr()
    {
        return $this->belongsTo(User::class, 'doctor_id')->withTrashed();
    }

    public function visits()
    {
        return $this->hasMany(OrthodonticVisit::class, 'orthodontic_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(OrthodonticPrescription::class);
    }
}
