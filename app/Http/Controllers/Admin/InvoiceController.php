<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class InvoiceController extends Controller
{
    use JodaResource;

// public function __construct()
// {
//     $this->middleware('permission:read_invoices')->only('index');
//     $this->middleware('permission:create_invoices')->only(['create', 'store']);
//     $this->middleware('permission:update_invoices')->only(['edit', 'update']);
//     $this->middleware('permission:delete_invoices')->only('destroy');
// }
}
