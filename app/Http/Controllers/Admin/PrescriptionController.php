<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Exports\PrescriptionsExport;
use App\Imports\PrescriptionsImport;
use Maatwebsite\Excel\Facades\Excel;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::latest()->paginate(10); 

        return view('admin.prescription', compact('prescriptions'));
    }
    public function export()
    {
        return Excel::download(new PrescriptionsExport, 'prescriptions.xlsx');
    }
    
    // استيراد البيانات من ملف Excel
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,csv',
        ]);
    
        Excel::import(new PrescriptionsImport, $request->file('import_file'));
        
        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'تم استيراد البيانات بنجاح.');
    }

    public function create()
    {
        return view('admin.prescription');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:prescriptions,name',
            'strength' => 'required',
            'commercial_name' => 'nullable',
            'department_id' => 'nullable',


        ]);

        Prescription::create([
            'name' => $request->input('name'),
            'strength' => $request->input('strength'),
            'commercial_name' => $request->input('commercial_name'),
            'department_id' => $request->input('department_id'),



        ]);

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'تمت إضافة الوصفة الطبية بنجاح');
    }

    public function edit(Prescription $prescriptions)
    {
        // $prescription = Prescription::find($id);
        return view('admin.prescription', compact('prescriptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:prescriptions,name,' . $id,
            'strength' => 'required',
            'commercial_name' => 'nullable',
            'department_id' => 'nullable',

        ]);

        $prescription = Prescription::find($id);
        $prescription->name = $request->input('name');
        $prescription->strength = $request->input('strength');
        $prescription->commercial_name = $request->input('commercial_name');
        $prescription->department_id = $request->input('department_id');

        $prescription->save();

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'تم تحديث الوصفة الطبية بنجاح');
    }

    public function destroy($id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'تم حذف الوصفة الطبية بنجاح');
    }

    public function show($id)
{
}
 

}
