<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'cost', 'depreciable'];

    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id')->withDefault();
    }

    public function kids()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public static function parents()
    {
        return self::whereNull('parent_id')->get();
    }

    public function vouchersAccounts()
    {
        return $this->hasMany(VoucherAccount::class);
    }

    public function subAssets()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }
}
