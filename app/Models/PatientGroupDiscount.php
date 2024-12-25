<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientGroupDiscount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(PatientGroup::class,'group_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

