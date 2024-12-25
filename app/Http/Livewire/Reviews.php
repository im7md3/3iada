<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Department;
use App\Services\Whatsapp;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\Taqnyat\SMS;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Log;

class Reviews extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $date, $dr, $period, $department, $transferred, $search, $appointment_status, $note;
    public $transfer_mode = false, $trans_patient, $waiting, $clinic_id, $doctor_id, $appointment_duration, $review_type;

    public function mount($transferred = false)
    {
        if (auth()->user()->type == 'dr') {
            abort(403);
        }
        $this->transferred = $transferred;
    }

    public function presence(Appointment $appointment)
    {
        $appointment->update(['attended_at' => now()]);
    }

    public function notPresence(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
        $phone = substr($appointment->patient->phone, 1);
        $message = 'مرحبا بك  ' . $appointment->patient->name . ' تم الغاء الموعد بتاريخ ' . $appointment->appointment_date . ' الساعة ' . date('h:i A', strtotime($appointment->appointment_time)) . ' مع الطبيب ' . $appointment->doctor?->name . ' عيادة :' . $appointment->clinic?->name;
        $statusObject = json_decode(setting()->taqnyat_modules_status, true);
        $smsStatus = isset($statusObject['reject_appointment']) ? $statusObject['reject_appointment'] : null;
        if (setting()->taqnyat_status && $smsStatus == '1') {
            $response = SMS::send(['966' . $phone], $message);
            if ($response?->statusCode != 200) {
                Log::info(json_encode($response));
            }
        }

        try {
            if ($appointment->patient->phone) {
                WhatsappMessage::create([
                    'message' => $message,
                    'patient_id' => $appointment->patient->id,
                    'user_id' => auth()->user()->id,
                ]);
                Whatsapp::send($appointment->patient->phone, $message);
            }
        } catch (\Throwable $th) {
        }
    }

    public function render()
    {
        $this->waiting = Appointment::where('doctor_id', $this->doctor_id)
            ->Transferred()
            ->count() + 1;
        $appoints_for_review = Appointment::NeedReview()->count();
        $appoints_no_review = Appointment::NoReview()->count();

        $appoints = Appointment::where(function ($q) {
            if ($this->date) {
                $q->where('appointment_date', $this->date);
            }
            if ($this->review_type !== null) {
                if ($this->review_type !== 'reset') {
                    $q->where('review', $this->review_type);
                }
            }
            if ($this->dr) {
                $q->where('doctor_id', $this->dr);
            }
            if ($this->period) {
                $q->where('appointment_duration', $this->period);
            }
            if ($this->department) {
                $q->where('clinic_id', $this->department);
            }
            if ($this->appointment_status) {
                if ($this->appointment_status == 'review') {
                    $q->where('review', true);
                } else {
                    $q->where('appointment_status', $this->appointment_status);
                }
            }
            if ($this->search) {
                $q->whereHas('patient', function ($q) {
                    $q->where('id', $this->search)->orWhere(function ($q) {
                        $q->orWhere('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone', 'like', '%' . $this->search . '%')
                            ->orWhere('civil', 'like', '%' . $this->search . '%');
                    });
                });
            }
            if ($this->transferred) {
                $q->Transferred();
            }
            if (request('today')) {
                $q->today();
            }
        })->where('review', true)->orderBy('appointment_time', 'asc')->paginate(10);
        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', $this->department)->get();
        return view('livewire.reviews', compact('appoints', 'departments', 'doctors', 'appoints_no_review', 'appoints_for_review'));
    }

    public function resetAll()
    {
        $this->reset('date', 'dr', 'period', 'department', 'appointment_status', 'review_type');
    }

    public function setNoteValue(Appointment $appointment)
    {
        $this->note = $appointment->notes;
        // $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('تم حفظ الملاحظة بنجاح')]);

    }

    public function saveNote(Appointment $appointment)
    {
        $appointment->update(['notes' => $this->note]);
        // $this->reset(['note']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم الحفظ بنجاح')]);

    }

    public function transfer(Patient $patient)
    {
        // dd( $patient);
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
        $data['appointment_status'] = 'transferred';
        $data['appointment_time'] = date('H:i');
        $data['appointment_date'] = date('Y-m-d');
        $appoint = Appointment::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('The patient has been successfully transferred')]);
        if ($print) {
            return redirect()->route('front.appointment.print-transfer', ['appointment' => $appoint, 'waiting' => $this->waiting]);
        }
        $this->reset();
    }

    public function reminder(Appointment $appointment)
    {
        $phone = 966 . $appointment->patient?->phone;
        $message = 'نذكرك بموعدك غداً عند الطبيب ' . $appointment->doctor?->name . ' الساعة ' . $appointment->appointment_time . ' عيادة ' . $appointment->doctor?->department?->name;
        $response = SMS::send([$phone], $message);
        // dd($response);
        if (!in_array($response?->statusCode, [200, 201])) {
            $message = 'خطأ في ارسال رسالة الي المريض ' . $appointment->patient?->name . ' الخطأ : ' . json_encode($response);
            Log::info($message);
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => $message]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'تم ارسال الرسالة بنجاح']);
        }
    }
}
