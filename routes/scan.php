<?php

use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Front\PatientsController;
use App\Http\Controllers\Front\AppointmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/scan',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::group(['middleware' => 'auth'], function () {
            Route::view('', 'scan.home')->name('home');
            Route::view('interface', 'doctor.interfaces.interface')->name('interface');

            Route::view('patients', 'scan.patients.index')->name('patients.index')->middleware('permission:read_patients');
            Route::view('requests', 'scan.requests.requests')->name('requests');
        });
    }
);
