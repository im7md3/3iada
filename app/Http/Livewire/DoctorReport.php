<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class DoctorReport extends Component
{
    public $from,$to,$status;
    public $totalPaidWithTax = 0;
    public $totalPaidWithoutTax = 0;
    public $totalUnpaidWithTax = 0;
    public $totalUnpaidWithoutTax = 0;
    public $totalPaidAll = 0;
public $totalUnpaidAll = 0;
public $totalAll = 0;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function resetForm()
    {
        $this->reset('from','to','status');
    }
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } elseif($this->status) {
           $query->where('status', $this->status);
        } else {
            $query;
        }
    }
    // public function render()
    // {
    //     $invoices=doctor()->invoices()->where(function($q){
    //         $this->between($q);
    //     })->latest()->paginate(10);
    //     $rate=0;
    //     foreach($invoices as $invoice){
    //         $rate += $invoice->total * (doctor()->rate/100);
    //     }
    //     return view('livewire.doctor-report',compact('invoices','rate'));
    // }
    public function render()
    {
        $invoices = doctor()->invoices()->where(function ($q) {
            $this->between($q);
        })->latest()->paginate(10);

        // حساب المجموع للفواتير المسددة بالضرائب عبر جميع الصفحات
        $this->totalPaidWithTax = doctor()->invoices()->where(function ($q) {
            $this->between($q);
        })->where('status', 'Paid')->where('tax', '>', 0)->sum('total');

        // حساب المجموع للفواتير المسددة بدون ضرائب عبر جميع الصفحات
        $this->totalPaidWithoutTax = doctor()->invoices()->where(function ($q) {
            $this->between($q);
        })->where('status', 'Paid')->where('tax', 0)->sum('total');

        // حساب المجموع للفواتير غير المسددة بالضرائب عبر جميع الصفحات
        $this->totalUnpaidWithTax = doctor()->invoices()->where(function ($q) {
            $this->between($q);
        })->where('status', 'Unpaid')->where('tax', '>', 0)->sum('total');

        // حساب المجموع للفواتير غير المسددة بدون ضرائب عبر جميع الصفحات
        $this->totalUnpaidWithoutTax = doctor()->invoices()->where(function ($q) {
            $this->between($q);
        })->where('status', 'Unpaid')->where('tax', 0)->sum('total');

        $totalPaidWithTax = $this->totalPaidWithTax;
        $totalPaidWithoutTax = $this->totalPaidWithoutTax;
        $totalUnpaidWithTax = $this->totalUnpaidWithTax;
        $totalUnpaidWithoutTax = $this->totalUnpaidWithoutTax;
    
        $this->totalAll = $totalPaidWithTax + $totalPaidWithoutTax + $totalUnpaidWithTax + $totalUnpaidWithoutTax;

        $rate = 0;
        foreach ($invoices as $invoice) {
            $rate += $invoice->total * (doctor()->rate / 100);
        }

        return view('livewire.doctor-report', compact('invoices', 'rate'));
    }
}
