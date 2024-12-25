<?php

namespace App\Http\Controllers\Front;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class InvoiceController extends Controller
{
    use JodaResource;

    // public function __construct()
    // {
    //     $this->middleware('permission:read_invoices')->only(['index', 'bonds']);
    //     $this->middleware('permission:create_invoices')->only(['create', 'store']);
    //     $this->middleware('permission:update_invoices')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_invoices')->only('destroy');
    // }


    public function query($query)
    {
        return $query->where(function ($q) {
            if (request()->from) {
                $q->whereDate('created_at', '>=', request()->from);
            }
        })
            ->where(function ($q) {
                if (request()->to) {
                    $q->whereDate('created_at', '<=', request()->to);
                }
            });
    }


    public function bonds(Invoice $invoice)
    {
        return view('front.invoice.bonds', compact('invoice'));
    }


    public function all_bonds()
    {
        return view('front.invoice.all_bonds');
    }
}
