<?php

namespace App\Http\Livewire\Reports;

use App\Exports\InsurancesExport;
use App\Models\Insurance;
use App\Models\Invoice;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class InsurancesReport extends Component
{
    public $selected_insurance, $insurance;
    public Collection $allinvoices;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function updatedInsurance()
    {
        $this->selected_insurance = null;
        if ($this->insurance) {
            $this->selected_insurance = Insurance::withCount('patients')->findOrFail($this->insurance);
        }
    }
    public function export()
    {
        return Excel::download(new InsurancesExport($this->allinvoices), 'reception-staff'.time().'.xlsx');
    }
    public function render()
    {
        $insurances = Insurance::all();
        $invoices = Invoice::with('patient')->whereRelation('patient', 'insurance_id', '<>', null)->where(function ($q) {
            if ($this->insurance) {
                $q->whereRelation('patient', 'insurance_id', $this->insurance);
            }
        })->latest()->paginate(10);
        $this->allinvoices = Invoice::with('patient')->whereRelation('patient', 'insurance_id', '<>', null)->where(function ($q) {
            if ($this->insurance) {
                $q->whereRelation('patient', 'insurance_id', $this->insurance);
            }
        })->latest()->get();
        return view('livewire.reports.insurances-report', compact('invoices', 'insurances'));
    }
}
