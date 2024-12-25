<?php

namespace App\Http\Livewire\Reports;

use App\Exports\NotSaudisExport;
use App\Models\Invoice;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class NotSaudis extends Component
{
    public $from, $to, $paid, $department_id, $dr_id, $status;
    public Collection $allinvoices;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function export()
    {
        return Excel::download(new NotSaudisExport($this->allinvoices , $this->from , $this->to), 'reception-staff'.time().'.xlsx');
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
    public function render()
    {
        $invoices = Invoice::with(['patient'])->where(function ($q) {
            $q->whereRelation('patient','country_id','<>', 1);
            $this->between($q);
        })->latest()->paginate(10);
        $this->allinvoices = Invoice::with(['patient'])->where(function ($q) {
            $q->whereRelation('patient','country_id','<>', 1);
            $this->between($q);
        })->latest()->get();
        $all_invoices=Invoice::where(function ($q) {
            $q->whereRelation('patient','country_id','<>', 1);
        })->get();
        return view('livewire.reports.not-saudis',compact('invoices','all_invoices'));
    }
}
