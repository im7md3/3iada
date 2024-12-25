<?php

namespace App\Http\Livewire\DoctorPatients;

use Livewire\Component;
use App\Models\Diagnose;
use App\Models\Appointment;
use App\Models\PatientFile;
use App\Models\Report;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ViewPatient extends Component
{
    public $patient,$report,$recipient, $details_en, $details, $screen = 'data', $invoice_status, $file, $file_name,$patientFilesType = 'dentist';
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    use WithFileUploads;
    protected function rules()
    {
        return [
            'file_name' => 'required',
            'file' => 'required',
        ];
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
    public function save_file()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['file_path'] = store_file($this->file, 'patients_file');
        $data['file_type'] = $this->file->getExtension();
        $data['file_size'] = $this->file->getSize();
        $data['employee_id'] = auth()->id();
        unset($data['file']);
        PatientFile::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset(['file_name', 'file']);
    }

    public function delete_file(PatientFile $file)
    {
        $file->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
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
        $orthodontics = $this->patient->orthodontics()->with(['department', 'dr'])->latest()->paginate(5);
        $files = $this->patient->files()->with(['patient', 'employee'])->latest()->paginate(5);
        $scanRequests = $this->patient->scanRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        $labRequests = $this->patient->labRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        // dd($diagnoses);
        $reports = Report::where('patient_id', $this->patient->id)->get();

        return view('livewire.doctor-patients.view-patient', compact('labRequests', 'orthodontics','scanRequests', 'invoices', 'appoints', 'diagnoses', 'files','reports'));
    }
}
