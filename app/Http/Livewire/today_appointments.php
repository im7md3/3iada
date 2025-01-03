<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Diagnose;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class today_appointments extends Component
{
    public $filter_depart,$filter_dr;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';



    public function render()
    {
        $appoints=Appointment::where('appointment_date', date('Y-m-d'))->where(function($q){
            if($this->filter_dr){
                $q->where('doctor_id',$this->filter_dr);
            }
            if($this->filter_depart){
                $q->where('clinic_id',$this->filter_depart);
            }
        })->orderBy('appointment_time', 'asc')->latest()->paginate(10);
        return view('livewire.today_appointments',compact('appoints'));
    }
}
