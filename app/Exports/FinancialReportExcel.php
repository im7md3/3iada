<?php

namespace App\Exports;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinancialReportExcel implements FromArray
{
    public $from,$to;

    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }



    public function array() :array
    {
       return [
            [__('paid_invoices'),Invoice::where('status', 'Paid')->where(function ($q) { $this->between($q); })->sum('total')],
          [__('unpaid_invoices'),Invoice::where('status', 'Unpaid')->where(function ($q) { $this->between($q); })->sum('total')],
          [__('retrieved_invoices'),Invoice::where('status', 'retrieved')->where(function ($q) { $this->between($q); })->sum('total')],
          [__('partially_paid'),Invoice::where('status', 'Partially Paid')->where(function ($q) { $this->between($q); })->sum('total')],
          [__('tab'),Invoice::where('tab', 1)->where(function ($q) { $this->between($q); })->sum('total')]  ,
          [__('tax'),Invoice::where(function ($q) { $this->between($q); })->sum('tax')],
          [__('expenses'),Expense::where(function ($q) { $this->between($q); })->sum('amount')],
          [__('purchases'),Purchase::where(function ($q) { $this->between($q); })->sum('amount')],
          [__('cash'),Invoice::where(function ($q) { $this->between($q); })->sum('cash')],
          [__('card'),Invoice::where(function ($q) { $this->between($q); })->sum('card')],
          [__('bank'),Invoice::where(function ($q) { $this->between($q); })->sum('bank')],
          [__('visa'),Invoice::where(function ($q) { $this->between($q); })->sum('visa')],
          [__('mastercard'),Invoice::where(function ($q) { $this->between($q); })->sum('mastercard')]
        ];
        // dd($data);
    }

    // public function headings(): array
    // {
    //     return [
    //         __('paid_invoices'),
    //         __('unpaid_invoices'),
    //         __('retrieved_invoices'),
    //         __('partially_paid'),
    //         __('tab'),
    //         __('tax'),
    //         __('expenses'),
    //         __('purchases'),
    //         __('cash'),
    //         __('card'),
    //         __('bank'),
    //         __('visa'),
    //         __('mastercard'),
    //     ];
    // }
}
