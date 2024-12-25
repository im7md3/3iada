<?php

namespace App\Http\Livewire\Front\Reports;

use Livewire\Component;
use App\Models\DiagnosePrescription;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Reports\PrescriptionExport;


class Prescriptions extends Component
{

    public $from,$to;
    public function render()
    {
        $prescriptions = DiagnosePrescription::latest()->where(function($q){
            if($this->from && $this->to){
                $q->whereBetween('created_at',[$this->from,$this->to]);
            }elseif($this->from){
                $q->where('created_at', '>',$this->from);
            }elseif($this->to){
                $q->where('created_at', '<',$this->to);
            }
        })->get();
        return view('livewire.front.reports.prescriptions',compact('prescriptions'));
    }

    public function export()
    {
        return Excel::download(new PrescriptionExport($this->from,$this->to),time() . '.xlsx');
    }
}
