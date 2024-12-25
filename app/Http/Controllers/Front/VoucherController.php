<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    use JodaResource;

    public function query($query)
    {
        return $query->get();
    }

    public function report()
    {
        return view('front.voucher.report');
    }
}
