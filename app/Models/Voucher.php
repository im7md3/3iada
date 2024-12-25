<?php

namespace App\Models;

use App\Traits\EmployeeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory, EmployeeTrait;

    protected $fillable = [
        'date', 'accounts', 'invoice_id', 'employee_id', 'voucher_no',
    ];

    public function accounts()
    {
        return $this->hasMany(VoucherAccount::class);
    }


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function getCreditAttribute()
    {
        return $this->accounts->sum('credit');
    }

    public function getDebitAttribute()
    {
        return $this->accounts->sum('debit');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id')->withTrashed();
    }
}
