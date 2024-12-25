<?php

namespace App\Http\Controllers\Front;

use App\Models\Diagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class DiagnoseController extends Controller
{
    use JodaResource;

    // public function __construct()
    // {
    //     $this->middleware('permission:read_diagnoses')->only('index');
    //     $this->middleware('permission:create_diagnoses')->only(['create', 'store']);
    //     $this->middleware('permission:update_diagnoses')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_diagnoses')->only('destroy');
    // }


    public function query($query)
    {
        return $query->with(['appoint', 'dr'])->latest()->paginate(10);
    }
}
