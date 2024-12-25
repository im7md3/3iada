<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InstallmentCompanyExport implements FromView
{
    public $invoices, $from, $to;
    public function __construct($invoices, $from, $to)
    {
        $this->invoices = $invoices;
        $this->from = $from;
        $this->to = $to;
    }
    public function view(): View
    {

        return view('exports.InstallmentCompanyExport', [
            'invoices' => $this->invoices,
            'from'     => $this->from,
            'to'     => $this->to
        ]);
    }
}
