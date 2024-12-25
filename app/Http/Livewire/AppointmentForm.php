<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;
use App\Services\Whatsapp;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Services\Taqnyat\SMS;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Log;
use App\Services\WhatsappMessageHandler;

class AppointmentForm extends Component
{
    public $appointment, $appointment_id, $patient, $doctor_id, $patient_id, $clinic_id, $appointment_date, $appointment_time, $appointment_time_end, $appointment_status, $appointment_duration, $patient_key, $review, $notes;

    public function rules()
    {
        return [
            'patient' => 'required',
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_time_end' => setting()->end_time_status ? 'required' : 'nullable',
            'appointment_duration' => 'required',
            'appointment_status' => 'required',
            'review' => 'nullable',
            'notes' => 'nullable'
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('phone', $this->patient_key)
            ->orWhere('first_name', 'like',"%$this->patient_key%")
            ->orWhere('civil', $this->patient_key)
            ->orWhere('id', $this->patient_key)
            ->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
            if ($this->patient->invoices()->unpaid()->count() > 0) {
                $this->emit('unpaid');
            }
            if ($this->patient->invoices()->partiallyPaid()->count() > 0) {
                $this->emit('partiallyPaid');
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    public function save()
    {
        if (setting()->from_morning || setting()->from_evening) {
            $data = $this->validate();
            if (!setting()->end_time_status) {
                $data['appointment_time_end'] = null;
            }

            $appointment = Appointment::where('appointment_date', $this->appointment_date)
                ->where('appointment_time', $this->appointment_time)
                ->where('doctor_id', $this->doctor_id)
                ->first();
            if ($appointment && !$this->appointment) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'هناك موعد بهذا التاريخ والوقت']);
                return;
            }

            unset($data['patient']);
            $data['employee_id'] = auth()->id();
            $data['patient_id'] = $this->patient->id;
            // $data['appointment_status'] = Carbon::parse($this->appointment_date)->format('Y-m-d') > today()->format('Y-m-d') ? 'confirmed' : 'pending';
            $data['appointment_status'] = $this->appointment_status;
            $data['appointment_time'] = date('H:i', strtotime($this->appointment_time));
            if ($this->appointment?->id) {
                $this->appointment->update($data);
            } else {
                $data['appointment_number'] = Str::random(10);

                $this->appointment = Appointment::create($data);
                WhatsappMessageHandler::notify($this->appointment, 'create');
                $this->sendSms();
            }
            session()->flash('success', __('Saved successfully'));



            return redirect()->route('front.appointments.index');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد المواعيد من الاعدادات أولاً']);
        }
    }

    public function mount($appointment = null)
    {
        if (auth()->user()->type == 'dr') {
            abort(403);
        }
        // $appointment = Appointment::find($appointment->id);
        $this->appointment = $appointment;
        $this->patient = $appointment ? $appointment->patient : null;
        $this->patient_id = $appointment ? $appointment->patient_id : null;
        $this->doctor_id = $appointment ? $appointment->doctor_id : null;
        $this->clinic_id = $appointment ? $appointment->clinic_id : null;
        $this->review = $appointment ? $appointment->review : null;
        $this->notes = $appointment ? $appointment->notes : null;
        $this->appointment_status = $appointment ? $appointment->appointment_status : 'confirmed';
        $this->appointment_duration = $appointment
            ? $appointment->appointment_duration
            : (request()->has('appointment_duration') ? request()->appointment_duration : null);
        $this->appointment_date = $appointment
            ? $appointment->appointment_date
            : (request()->has('appointment_date') ? request()->appointment_date : now()->format('Y-m-d'));
        $this->appointment_time = $appointment
            ? $appointment->appointment_time
            : (request()->has('appointment_time') ? request()->appointment_time : now()->format('H:i'));
        $this->appointment_time_end = $appointment
            ? $appointment->appointment_time_end
            : (request()->has('appointment_time_end') ? request()->appointment_time_end : now()->format('H:i'));
    }

    private function sendSms()
    {
        $statusObject = json_decode(setting()->taqnyat_modules_status, true);
        $smsStatus = isset($statusObject['create_appointment']) ? $statusObject['create_appointment'] : null;
        $message =  'مرحبا بك  ' . $this->patient->name . ' تم حجز موعد جديد بتاريخ ' . $this->appointment_date . ' الساعة ' . date('h:i A', strtotime($this->appointment_time)) . ' مع الطبيب ' . $this->appointment->doctor?->name . ' عيادة :' . $this->appointment->clinic?->name;
        if (setting()->taqnyat_status && $smsStatus == '1') {
            $phone = substr($this->patient->phone, 1);
            $response = SMS::send(['966' . $phone], $message);
            if ($response?->statusCode != 200) {
                Log::info(json_encode($response));
            }
        }
        try {
            if ($this->patient->phone) {
                WhatsappMessage::create([
                    'message' => $message,
                    'patient_id' => $this->patient->id,
                    'user_id' => auth()->user()->id,
                ]);
                Whatsapp::send($this->patient->phone, $message);
            }
        } catch (\Throwable $th) {
        }
    }

    public function render()
    {
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $doctor = User::find($this->doctor_id);
        $reservedTimes = [];
        if ($this->appointment_duration == 'morning') {
            $diffInMinutes = Carbon::parse(setting()->from_morning)->diffInMinutes(Carbon::parse(setting()->to_morning));
            if ($doctor?->session_duration > 0) {
                $last_time = $diffInMinutes / $doctor?->session_duration;
            } else {
                $last_time = $diffInMinutes / 30;
            }

            $start = Carbon::createFromTime($from_morning, 0, 0);
            $times = [];
            $times[] = $start->format('H:i');
            for ($i = 1; $i < ($last_time + 1); $i++) { // add 1 to fix missing 1 min in morning duration
                $time = $start->addMinutes($doctor ? $doctor?->session_duration : 30);
                $times[] = $time->format('H:i');
            }
            if (setting()->end_time_status) {
                $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                    ->whereBetween('appointment_time', [(int) $from_morning, (int) $to_morning])
                    ->where('doctor_id', $this->doctor_id)
                    ->whereIn('appointment_status', ['pending', 'confirmed'])
                    ->where(function ($q) {
                        if ($this->appointment) {
                            $q->where('id', '!=', $this->appointment->id);
                        }
                    })
                    ->select('appointment_time', 'appointment_time_end')->get()
                    ->toArray();
            } else {
                $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                    ->whereBetween('appointment_time', [(int) $from_morning, (int) $to_morning])
                    ->where('doctor_id', $this->doctor_id)
                    ->whereIn('appointment_status', ['pending', 'confirmed'])
                    ->where(function ($q) {
                        if ($this->appointment) {
                            $q->where('id', '!=', $this->appointment->id);
                        }
                    })
                    ->pluck('appointment_time')->toArray();
            }
        } elseif ($this->appointment_duration == 'evening') {
            $evening_time = Carbon::createFromFormat('H:i', setting()->to_evening);
            $midnight = Carbon::createFromTime(0, 0, 0);
            $diffInMinutes = Carbon::parse(setting()->from_evening)->diffInMinutes($evening_time->greaterThan($midnight) && $evening_time->isNextDay() ? Carbon::parse(setting()->to_evening)->addDay() : Carbon::parse(setting()->to_evening));
            if ($doctor?->session_duration > 0) {
                $last_time = $diffInMinutes / $doctor?->session_duration;
            } else {
                $last_time = $diffInMinutes / 30;
            }

            $start = Carbon::createFromTime($from_evening, 0, 0);
            $times = [];
            $times[] = $start->format('H:i');
            for ($i = 1; $i < ($last_time + 1); $i++) { // add 1 to fix missing 1 min in morning duration
                $time = $start->addMinutes($doctor ? $doctor?->session_duration : 30);
                $times[] = $time->format('H:i');
            }
            if (setting()->end_time_status) {
                $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                    ->whereBetween('appointment_time', [(int) $from_evening, (int) $to_evening])
                    ->where('doctor_id', $this->doctor_id)
                    ->whereIn('appointment_status', ['pending', 'confirmed'])
                    ->where(function ($q) {
                        if ($this->appointment) {
                            $q->where('id', '!=', $this->appointment->id);
                        }
                    })
                    ->select('appointment_time', 'appointment_time_end')->orderby('appointment_time')->get()
                    ->toArray();
            } else {
                $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                    ->whereBetween('appointment_time', [(int) $from_evening, (int) $to_evening])
                    ->where('doctor_id', $this->doctor_id)
                    ->whereIn('appointment_status', ['pending', 'confirmed'])
                    ->where(function ($q) {
                        if ($this->appointment) {
                            $q->where('id', '!=', $this->appointment->id);
                        }
                    })
                    ->pluck('appointment_time')->toArray();
            }

            // dd($reservedTimes, $times);
        }
        return view('livewire.appointment-form', compact('reservedTimes', 'times'));
    }
}
