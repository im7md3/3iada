<?php

namespace App\Http\Livewire\Patients;

use App\Models\Report;
use Livewire\Component;
use App\Models\LabRequest;
use App\Models\VisionTest;
use App\Services\Whatsapp;
use App\Models\Appointment;
use App\Models\PatientFile;
use App\Models\ScanRequest;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use App\Services\Taqnyat\SMS;
use Livewire\WithFileUploads;
use App\Models\WhatsappMessage;
use App\Models\PatientPregnancy;
use App\Models\PregnancyCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ViewPatient extends Component
{
    public $patient, $screen = 'data', $body, $screen_file = 'medical_files', $invoice_status, $scan_file, $lab_file, $file_name, $scan_dr_content, $lab_dr_content, $file, $type, $patientFilesType = 'selectSrv';
    protected $paginationTheme = 'bootstrap';
    public $recipient, $details, $report, $details_en;
    public $pregnancyId, $pregnancy;
    /**
     * @var string
     */
    public $discribeScreen='index';
    use WithPagination;
    use WithFileUploads;

    protected function rules()
    {
        return [
            'file_name' => 'required',
            'file' => 'required',
        ];
    }

    public function save_file()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['file_path'] = store_file($this->file, 'patients_file');
        $data['file_type'] = $this->file->getExtension();
        $data['file_size'] = $this->file->getSize();
        $data['employee_id'] = auth()->id();
        unset($data['file']);

        if ($this->screen_file == 'medical_files') {
            $data['type'] = 'medical_files';
        } elseif ($this->screen_file == 'sick_leave') {
            $data['type'] = 'sick_leave';
        } else {
            $data['type'] = 'prescription';
        }

        PatientFile::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['file_name', 'file']);
    }
    public function setPregnancy(PregnancyCategory $pregnancy)
    {
        $this->pregnancy = $pregnancy;
        $this->pregnancyId = $pregnancy->id;
    }

    public function delete_file(PatientFile $file)
    {
        $file->delete();
        delete_file($file->file_path);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $invoices = $this->patient->invoices()->with(['dr', 'employee'])->where(function ($q) {
            if ($this->invoice_status) {
                $q->where('status', $this->invoice_status);
            }
        })->latest()->paginate(5);
        $appoints = $this->patient->appointments()->with(['clinic', 'doctor'])->latest()->paginate(5);
        $diagnoses = $this->patient->diagnoses()->with(['department', 'dr'])->latest()->paginate(5);
        $files = $this->patient->files()->with(['patient', 'employee'])->latest()->paginate(5);
        $scanRequests = $this->patient->scanRequests()->latest()->paginate(5);
        $labRequests = $this->patient->labRequests()->latest()->paginate(5);
        $visions = $this->patient->vision_tests()->with('dr')->get();
        $this->body = $this->getBodyPoints();
        $reports = Report::where('patient_id', $this->patient->id)->get();
        $medicalAppoints = $this->patient->appointments()->with(['clinic', 'doctor'])->latest()->paginate(5);

        return view('livewire.patients.view-patient', compact('visions', 'medicalAppoints','reports', 'invoices', 'appoints', 'diagnoses', 'files', 'scanRequests', 'labRequests'));
    }

    public function storeFileScan(ScanRequest $scan)
    {
        $this->validate([
            'scan_file' => 'required', // 1MB Max
            'scan_dr_content' => 'nullable', // 1MB Max
        ]);

        $scan->file = store_file($this->scan_file, 'scans');
        $scan->scan_content = $this->scan_dr_content;
        $scan->status = 'done';
        $scan->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['scan_dr_content', 'scan_file']);
    }

    public function storeFileLab(LabRequest $lap)
    {
        $data = $this->validate([
            'lab_file' => 'required', // 1MB Max
            'lab_dr_content' => 'nullable', // 1MB Max
        ]);
        $lap->file = store_file($this->lab_file, 'labs');
        $lap->lab_content = $this->lab_dr_content;
        $lap->status = 'done';
        $lap->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->reset(['lab_dr_content', 'lab_file']);
    }

    public function getBodyPoints()
    {
        $finalBodies = [];
        $bodies = $this->patient->diagnoses()->pluck('body')->toArray();
        $bodies = array_filter($bodies, function ($value) {
            return !empty($value);
        });
        if (count($bodies) > 0) {
            $finalBodies = [];
            foreach ($bodies as $body) {
                $finalBodies = array_replace_recursive($finalBodies, $body);
            }
        }

        return $finalBodies;
    }

    public function delete_vision($id)
    {
        VisionTest::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
        $this->dispatchBrowserEvent("deleteVision");
    }

    public function editReport($id)
    {
        $this->screen = 'edit_report';
        $this->report = Report::find($id);
        $this->details = $this->report->details;
        $this->recipient = $this->report->recipient;
    }
    public function showReport($id)
    {
        $this->screen = 'reports-show';
        $this->report = Report::find($id);
        $this->details = $this->report->details;
        $this->details_en = $this->report->details_en;
        $this->recipient = $this->report->recipient;
    }
    public function storeReport()
    {
        $data = $this->validate(['details' => 'required', 'recipient' => 'required', 'details_en' => 'required']);
        $data['patient_id'] = $this->patient->id;
        $data['creator_id'] = auth()->id();
        if ($this->report) {
            $this->report->update($data);
        } else {
            Report::create($data);
        }
        $this->screen = 'reports';
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function deleteReport($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_reports')) abort(403);
        $report = Report::findOrFail($id);
        $report->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('admin.deleted')]);
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
    public function showDescribe(Appointment $appointment)
    {
        $this->appointment = $appointment;
        $this->discribeScreen = 'show';
    }

    public function deleteDescribes(Appointment $appointment)
    {
        $appointment->describes()->delete();
        $this->discribeScreen = 'index';
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

}
