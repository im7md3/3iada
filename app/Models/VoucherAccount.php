<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'debit', 'credit', 'description','cost_center_id','user_id'
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class,'cost_center_id');
    }
}
