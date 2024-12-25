<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScanRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    // pending scope
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    //patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    //doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'dr_id');
    }
    //clinic
    public function clinic()
    {
        return $this->belongsTo(Department::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scan_name()
    {
        return $this->belongsTo(ScanName::class, 'scan_name_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function technical()
    {
        return $this->belongsTo(User::class, 'scan_tec_id');
    }
}
