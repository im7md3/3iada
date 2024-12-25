<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent', 'transferstatus', 'appointmentstatus', 'is_scan', 'is_lab'];

    public function main()
    {
        return $this->belongsTo(Self::class, 'parent');
    }
    public function children()
    {
        return $this->hasMany(Self::class, 'parent');
    }

    public function products()
    {
        return $this->hasMany(Department::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'department_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_departments');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'department_feature');

    }
}
