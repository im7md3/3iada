<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emergency extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'date', 'status', 'user_id', 'notes', 'marks', 'time', 'tec_id', 'invoice_id'];
    protected $casts = ['marks' => 'json'];
    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }
    public function scopeExamined($q)
    {
        return $q->where('status', 'examined');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class)->withDefault();
    }
    // public function patient(){
    //     return $this->belongsTo(Patient::class)->withTrashed()->withDefault();
    // }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed()->withDefault();
    }

    public function tec()
    {
        return $this->belongsTo(User::class, 'tec_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
