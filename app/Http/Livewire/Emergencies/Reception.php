<?php

namespace App\Http\Livewire\Emergencies;

use App\Models\Emergency;
use App\Models\Mark;
use Livewire\Component;

class Reception extends Component
{
    public $marks,$patient,$emergency,$emergencyMarks=[],$notes;
    public function selectEmergency(Emergency $emergency){
        $this->emergency=$emergency;
        $this->patient=$this->emergency->patient;
    }
    public function saveMarks(){
        $data=$this->validate([
            'emergencyMarks'=>'required',
            'notes'=>'nullable',
        ]);
        $data['marks']=$this->emergencyMarks;
        $data['status']='examined';
        $data['time']=now()->format("h:i:sa");
        $this->emergency->update($data);
        $this->reset('emergency','patient','emergencyMarks','notes');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('successfully added')]);

    }
    public function mount(){
        $this->marks=Mark::all();
    }
    public function render()
    {
        $emergencies=Emergency::pending()->with(['patient'])->get();
        return view('livewire.emergencies.reception',compact('emergencies'))->extends('front.layouts.front')->section('content');
    }
}
