<?php

namespace App\Http\Livewire\Patients;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Emergency;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Exports\PatientsExport;
use App\Events\SpecificUserEvent;
use Maatwebsite\Excel\Facades\Excel;

class Patients extends Component
{
    public $civil, $patient_id, $phone, $doctor_id, $clinic_id, $appointment_duration, $transfer_mode = false, $trans_patient, $waiting, $filter_visit, $first_name;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $technician_id, $emerg_id;
    // public function mount(Patient $patient)
    // {
    //     $this->trans_patient= $patient;
    // }

    protected function rules()
    {
        return [
            'doctor_id' => 'required',
            'appointment_duration' => 'required',
            'clinic_id' => 'required',
        ];
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

        $data = $this->validate();

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
        $this->reset();
    }
    public function delete(Patient $patient)
    {
        if ($patient->image) {
            delete_file($patient->image);
        }

        $patient->invoices()->delete();
        $patient->diagnoses()->delete();
        $patient->files()->delete();
        $patient->appointments()->delete();
        $patient->scanRequests()->delete();
        $patient->labRequests()->delete();

        $patient->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $this->waiting = \App\Models\Appointment::where('doctor_id', $this->doctor_id)
            ->Transferred()
            ->count() + 1;

        $doctors = User::whereType('dr')->whereHas('departments', function ($q) {
            $q->where('departments.id', $this->clinic_id);
        })->get();
        $patients = Patient::with(['country', 'user', 'invoices', 'appointments'])->where(function ($q) {
            if ($this->patient_id) {
                $q->where('id', $this->patient_id);
            }
            if ($this->civil) {
                $q->where('civil', 'LIKE', "%$this->civil%");
            }
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            if (request('toDay')) {
                $q->whereDate('created_at', toDay());
            }
            if (request('saudi') == true) {
                $q->where('country_id', 1);
            }
            if (request('saudi') == 'false') {
                $q->where('country_id', '<>', 1);
            }
            if ($this->filter_visit) {
                $q->where('visitor', true);
            }
            if ($this->first_name) {
                $q->where('first_name', 'LIKE', "%$this->first_name%");
            }
        })->latest()->paginate(10);
        return view('livewire.patients.patients', compact('patients', 'doctors'));
    }
    public function export()
    {
        $patients = Patient::with(['country', 'user', 'invoices'])->where(function ($q) {
            if ($this->patient_id) {
                $q->where('id', $this->patient_id);
            }
            if ($this->civil) {
                $q->where('civil', 'LIKE', "%$this->civil%");
            }
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            if (request('toDay')) {
                $q->whereDate('created_at', toDay());
            }
            if (request('saudi') == true) {
                $q->where('country_id', 1);
            }
            if (request('saudi') == 'false') {
                $q->where('country_id', '<>', 1);
            }
            if ($this->filter_visit) {
                $q->where('visitor', true);
            }
            if ($this->first_name) {
                $q->where('first_name', 'LIKE', "%$this->first_name%");
            }
        })->latest()->get();

        return Excel::download(new PatientsExport($patients), 'patients-' . time() . '-.xlsx');
    }
    public function emergency(Patient $patient)
    {
        $data = $this->validate(['emerg_id' => 'required']);
        $e = Emergency::where('patient_id', $patient->id)->where('date', now()->format('Y-m-d'))->where('status', 'pending')->first();
        if ($e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'warning', 'message' => "المريض مسجل في الطوارئ بالفعل"]);
            return true;
        }
//        if (!setting()->emergencies_price) {
//            $this->dispatchBrowserEvent('alert', ['type' => 'warning', 'message' => "يجب عليك تحديد تكلفة استقبال الطوارئ من الاعدادات"]);
//            return true;
//        }
//        $lastNumber = Invoice::latest()->first()?->id ?? 0;
//        $invoice = Invoice::create([
//            'invoice_number' => $lastNumber + 1,
//            'patient_id' => $patient->id,
//            'employee_id' => auth()->user()->id,
//            'total' => $patient->country_id != 1 ? ((setting()->emergencies_price * setting()->tax_rate) / 100) + setting()->emergencies_price : setting()->emergencies_price,
//            'amount' => setting()->emergencies_price,
//            'rest' => $patient->country_id != 1 ? ((setting()->emergencies_price * setting()->tax_rate) / 100) + setting()->emergencies_price : setting()->emergencies_price,
//            'tax' => $patient->country_id != 1 ? (setting()->emergencies_price * setting()->tax_rate) / 100 : 0,
//            'status' => 'Unpaid'
//        ]);
        $emergency =Emergency::create([
            'patient_id' => $patient->id,
            'date' => now()->format('Y-m-d'),
            'status' => 'pending',
//            'invoice_id' => $invoice->id,
            'tec_id' => $data['emerg_id']
        ]);
        return  redirect()->route('front.invoices.create',['emergency_id' =>$emergency->id ]);
//        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully added')]);
    }
}
