<?php

namespace App\Http\Livewire\Emergencies;

use App\Models\Mark;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Emergency;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Traits\livewireResource;
use App\Events\SpecificUserEvent;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use livewireResource;

    public $to, $from, $search, $civil, $phone, $name, $patient_id, $filter_status, $marks, $emergencyMarks = [], $notes, $emergency, $patient, $seen_filter, $e_patient;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $layout;
    public $trans_patient, $doctors, $clinic_id, $waiting, $appointment_duration, $doctor_id;

    public function rules()
    {
        return [];
    }

    public function setEmergency($id)
    {
        $this->e_patient = Emergency::find($id);
        $this->notes = $this->e_patient->notes;
//        dd($this->e_patient->marks);
        $this->emergencyMarks = $this->e_patient->marks;
    }

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('date', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function mount()
    {
        $this->model = 'App\Models\Emergency';
        $this->marks = Mark::all();
        if (auth()->user()->type == 'dr') {
            $this->layout = 'doctor.layouts.index';
        } elseif (auth()->user()->type == "scan") {
            $this->layout = 'scan.layouts.index';
        } elseif (auth()->user()->type == "lab") {
            $this->layout = 'lab.layouts.index';
        } else {
            $this->layout = 'front.layouts.front';
        }
    }

    //    public function end_session($id)
    //    {
    //        $emergency =Emergency::find($id);
    //        $emergency->update(['status' => 'examined']);
    //        \Session::flash('success_message', __('saved'));
    //
    //    }

    public function saveMarks($id)
    {

        $data = $this->validate([
            'emergencyMarks' => 'required',
            'notes' => 'nullable',
        ]);
        $emergency = Emergency::find($id);
        $data['marks'] = $this->emergencyMarks;
        $data['status'] = 'examined';
        $data['user_id'] = auth()->id();
        $data['time'] = now()->format("h:i:sa");
        $emergency->update($data);

        \Session::flash('success_message', __('successfully added'));
        $this->reset();
        return redirect()->to('/emergencies');
    }

    public function render()
    {
        $exmaEmergencies = Emergency::examined()->whereRelation('invoice', 'status', 'Paid')->count();
        $nonexmaEmergencies = Emergency::pending()->whereRelation('invoice', 'status', 'Paid')->count();
        $emergencies = Emergency::where(function (Builder $query) {
            $query->whereRelation('invoice', 'status', 'Paid');
            if (auth()->user()->type == 'emergency'){
                $query->where('tec_id',auth()->id());
            }
            if ($this->seen_filter) {
                $query->where('status', 'examined');
            } else {
                $query->where('status', 'pending');
            }
        })->latest('id')->paginate();
        $doctors = User::whereType('dr')->whereHas('departments', function ($q) {
            $q->where('departments.id', $this->clinic_id);
        })->get();

        return view('livewire.emergencies.index', compact('emergencies', 'exmaEmergencies', 'nonexmaEmergencies', 'doctors'))->extends($this->layout)->section('content');
    }


    public function transfer(Patient $patient)
    {
        $this->trans_patient = null;
        if (!$patient->has_appoint_trans) {
            $this->trans_patient = $patient;
            $this->emit('trans_modal');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('The patient is already transferred')]);
        }
    }

    public function submit_transfer($print = null)
    {

        $data = $this->validate([
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
        ]);

        $data['patient_id'] = $this->trans_patient->id;
        $data['employee_id'] = auth()->id();
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'transferred';
        $data['appointment_time'] = date('H:i');
        $data['appointment_date'] = date('Y-m-d');
        $appoint = Appointment::create($data);
        event(new SpecificUserEvent('يوجد معاد جديد', $appoint->doctor_id));
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
        $this->reset([
            'doctor_id',
            'appointment_duration',
            'clinic_id'
        ]);
    }
}
