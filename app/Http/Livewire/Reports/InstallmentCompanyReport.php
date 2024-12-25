<?php

namespace App\Http\Livewire\Reports;

use App\Exports\InstallmentCompanyExport;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class InstallmentCompanyReport extends Component
{
    public $to, $from, $company;
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
    public Collection $allinvoices;

    public function export()
    {
        return Excel::download(new InstallmentCompanyExport($this->allinvoices, $this->from, $this->to), 'installment company' . time() . '.xlsx');
    }
    public function render()
    {
        $invoices = Invoice::where(function ($q) {
            $this->between($q);
        })->where(function ($q) {
            if ($this->company == 'tamara') {
                $q->where('installment_company', true)->orWhere('tamara', '>', 0);
            } elseif ($this->company == 'tabby') {
                $q->where('tabby', '>', 0);
            } else {
                $q->where('installment_company', true)->orWhere('tabby', '>', 0)->orWhere('tamara', '>', 0);
            }
        })->paginate(10);

        $this->allinvoices = Invoice::where(function ($q) {
            $this->between($q);
        })->where(function ($q) {
            if ($this->company == 'tamara') {
                $q->where('installment_company', true)->orWhere('tamara', '>', 0);
            } elseif ($this->company == 'tabby') {
                $q->where('tabby', '>', 0);
            } else {
                $q->where('installment_company', true)->orWhere('tabby', '>', 0)->orWhere('tamara', '>', 0);
            }
        })->get();
        return view('livewire.reports.installment-company-report', compact('invoices'));
    }
}
