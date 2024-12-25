<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];
    // invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function diagnoses()
    {
        return $this->hasMany(Diagnose::class);
    }
    public function orthodontics()
    {
        return $this->hasMany(Orthodontic::class);
    }
    // files
    public function files()
    {
        return $this->hasMany(PatientFile::class);
    }
    public function medical_files()
    {
        return $this->hasMany(PatientFile::class)->where('type', 'medical_files');
    }
    public function sick_leave_files()
    {
        return $this->hasMany(PatientFile::class)->where('type', 'sick_leave');
    }
    public function prescription_files()
    {
        return $this->hasMany(PatientFile::class)->where('type', 'prescription');
    }
    // appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function group()
    {
        return $this->belongsTo(PatientGroup::class, 'patient_group_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->parent_name . ' ' . $this->grand_name . ' ' . $this->last_name;
    }
    public function getHasAppointTransAttribute()
    {
        // return $this->appointments()->latest()->first()->appointment_status == 'transferred' ? true : false;
    }
    // scan requests
    public function scanRequests()
    {
        return $this->hasMany(ScanRequest::class);
    }
    public function labRequests()
    {
        return $this->hasMany(LabRequest::class);
    }
    // set is pregnant attribute
    public function setIsPregnantAttribute($value)
    {
        $this->attributes['is_pregnant'] = $value ? 1 : 0;
    }
    public function treatment_plans()
    {
        return $this->hasMany(TreatmentPlan::class, 'patient_id');
    }
    public function vision_tests()
    {
        return $this->hasMany(VisionTest::class, 'patient_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'patient_id');
    }

    public function pregnancies()
    {
        return $this->hasMany(PatientPregnancy::class);
    }

    public function pregnancySession()
    {
        return $this->hasMany(PregnancyCategory::class);
    }

    public function emergenies()
    {
        return $this->hasMany(Emergency::class);
    }
}
