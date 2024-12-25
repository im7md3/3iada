<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class AppointmentController extends Controller
{
    use JodaResource;
    // public $permissions = [
    //     'read' => ['index'],
    //     'create' => ['create', 'store'],
    //     'update' => ['edit', 'update'],
    //     'delete' => ['destroy'],
    //     'presence_patients' => ['presence', 'notPresence'],
    // ];
    // public function __construct()
    // {

    //     $this->middleware('permission:read_appointments')->only('index');
    //     $this->middleware('permission:create_appointments')->only(['create', 'store']);
    //     $this->middleware('permission:update_appointments')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_appointments')->only('destroy');
    //     // parent::__construct();
    // }

    public function query($query)
    {
        return $query->where('appointment_date', today()->format('Y-m-d'))->latest()->paginate(10);
    }
}
