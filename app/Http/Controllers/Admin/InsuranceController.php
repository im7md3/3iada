<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class InsuranceController extends Controller
{
    use JodaResource;

    // public function __construct()
    // {
    //     $this->middleware('permission:read_insurances')->only('index');
    //     $this->middleware('permission:create_insurances')->only(['create', 'store']);
    //     $this->middleware('permission:update_insurances')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_insurances')->only('destroy');
    // }

    protected $rules = [
        'name' => 'required',
    ];
    public function query($query)
    {
        return $query->paginate(10);
    }
}
