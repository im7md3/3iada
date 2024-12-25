<?php

namespace App\Exports\Reports;

use App\Models\DiagnosePrescription;
use Maatwebsite\Excel\Concerns\FromCollection;

class PrescriptionExport implements FromCollection
{
    public $from,$to;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function collection()
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

        return $prescriptions;
    }
}
