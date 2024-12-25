<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Patient;
use App\Models\PatientFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function showPatientMedicalFiles(Patient $patient)
    {
        $type = request()->get('type') ?? 'medical_files';
        $screen_file = $type;
        return view('doctor.patients.medeical_file',compact('type','patient','screen_file'));
    }

    public function storePatientMedicalFiles(Request $request,Patient $patient)
    {
        $data = $request->validate([
            'file_path' => 'required',
            'file_name' => 'required',
            'type' => 'required'
        ]);
        $file = $request->file_path;
        // dd($file);
        $data['file_path'] = store_file($file, 'patient_files');
        $data['file_type'] = $file->getExtension();
        $data['file_size'] = $file->getSize();
        $data['patient_id'] = $patient->id;
        $data['employee_id'] = auth()->id();
        PatientFile::create($data);
        return redirect()->back()->with('success',__('Saved successfully'));
    }

    public function destroyPatientMedicalFile(PatientFile $file)
    {
        delete_file($file->file_path);
        $file->delete();
        return redirect()->back()->with('success', __('Successfully deleted'));

    }
}
