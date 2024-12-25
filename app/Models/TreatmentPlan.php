<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentPlan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function dr()
    {
        return $this->belongsTo(User::class, 'dr_id')->withTrashed();
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'treatment_plan_products', 'treatment_plan_id','product_id');
    }
}
