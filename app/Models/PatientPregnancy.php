<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientPregnancy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function months()
    {
        return $this->belongsTo(PatientPregnancyMonth::class, 'id', 'pregnancy_id');
    }
}
