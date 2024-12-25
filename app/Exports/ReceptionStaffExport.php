<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ReceptionStaffExport implements FromView
{
    public $all_users , $from , $to;
    public function __construct($all_users , $from , $to)
    {
        $this->all_users=$all_users;
        $this->from=$from;
        $this->to=$to;
    }
    public function view(): View
    {

            return view('exports.ReceptionStaffExport', [
                'all_users' => $this->all_users,
                'from'     => $this->from,
                'to'     => $this->to
            ]);

    }
}
