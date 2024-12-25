<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionTest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dr()
    {
        return $this->belongsTo(Doctor::class,'dr_id');
    }

}
