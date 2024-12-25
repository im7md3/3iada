<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentPlanProduct extends Model
{
    use HasFactory;
    protected $fillable=['treatment_plan_id','product_id'];
}
