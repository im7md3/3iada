<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiagnosePrescription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class,'diagnose_id');
    }
}
