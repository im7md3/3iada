<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class ProductController extends Controller
{
    use JodaResource;

    // public function __construct()
    // {
    //     $this->middleware('permission:read_products')->only('index');
    //     $this->middleware('permission:create_products')->only(['create', 'store']);
    //     $this->middleware('permission:update_products')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_products')->only('destroy');
    // }

    protected $rules = [
        'name' => 'required',
        'price' => 'required',
        'department_id' => 'required',
    ];

    public function query($query)
    {
        return $query->paginate(10);
    }
}
