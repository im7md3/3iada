<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PregnancyCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function pregnancies()
    {
        return $this->hasMany(PatientPregnancy::class, 'pregnancy_category_id');
    }
}
