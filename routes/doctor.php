<?php

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Doctor\MarkController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Front\PatientsController;
use App\Http\Controllers\Front\AppointmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/doctor',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::group(['middleware' => 'auth'], function () {
            Route::view('', 'doctor.home')->name('home');
            Route::view('interface', 'doctor.interfaces.interface')->name('interface');
            Route::view('appointments', 'doctor.appointments.index')->name('appointments')->middleware('permission:read_appointments');
            Route::view('appointments-info', 'doctor.appointments.info')->name('appointments_info')->middleware('permission:read_appointments');
            Route::resource('invoices', InvoiceController::class);
            Route::view('patients', 'doctor.patients.index')->name('patients.index')->middleware('permission:read_patients');
            Route::get('patients/{patient}', function (Patient $patient) {
                return view('doctor.patients.show', compact('patient'));
            })->name('patients.show')->middleware('permission:read_patients');
            Route::get('patients/patientFile/{patient}', function (Patient $patient) {
                return view('doctor.patients.patientFile', compact('patient'));
            })->name('patientFile')->middleware('permission:profile_patients');
            Route::view('report', 'doctor.report')->name('report')->middleware('permission:read_reports');

            Route::get('today_appointments', function () {
                $appoints = Appointment::where('appointment_date', date('Y-m-d'))->orderBy('appointment_time', 'asc')->get();
                return view('doctor.appointments.today_appointments', compact('appoints'));
            })->name('appointments.today_appointments')->middleware('permission:read_appointments');

            Route::view('offers', 'doctor.offers.index')->name('offers.index')->middleware('permission:read_offers');

            Route::get('patients/{patient}/files',[PatientController::class,'showPatientMedicalFiles'])->name('patients.medical');
            Route::post('patients/{patient}/files',[PatientController::class,'storePatientMedicalFiles'])->name('patients.medical.store');
            Route::delete('medical/files/{file}/destroy',[PatientController::class,'destroyPatientMedicalFile'])->name('patients.medical.destroy');
            Route::resource('marks', MarkController::class);

        });
    }
);
