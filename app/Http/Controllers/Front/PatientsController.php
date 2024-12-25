<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Country;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\Orthodontic;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_patients')->only('index');
        $this->middleware('permission:create_patients')->only(['create', 'store']);
        $this->middleware('permission:update_patients')->only(['edit', 'update']);
        $this->middleware('permission:delete_patients')->only('destroy');
        $this->middleware('permission:profile_patients')->only('patientFile');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with(['country', 'user'])->latest()->paginate(10);
        return view('front.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('front.patients.show', compact('patient'));
    }

    public function patientFile(Patient $patient)
    {
        return view('front.patients.patientFile', compact('patient'));
    }

    public function visits(Orthodontic $orthodontic)
    {


        return view('front.patients.orthodontic_visits', compact('orthodontic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('front.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
    }

    public function appointmentShow(Appointment $appointment)
    {
        $diagnose = $appointment->diagnos;
        $treatmentPlans = $appointment->treatmentPlans;
        $patient = $appointment->patient;
        return view('front.patients.appointment', compact('appointment', 'diagnose', 'treatmentPlans', 'patient'));
    }
}
