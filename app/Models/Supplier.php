<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'building_no',
        'city_id',
        'tax_no',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
