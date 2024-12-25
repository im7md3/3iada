<?php

use App\Models\Diagnose;
use App\Models\CostCenter;
use App\Models\UserManual;
use App\Models\VisionTest;
use App\Models\Appointment;
use App\Models\InvoiceBond;
use App\Models\Orthodontic;
use App\Models\PatientGroup;
use App\Models\ProgramModule;
use App\Http\Livewire\Accounts;
use App\Models\PregnancyCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Emergencies\Index;
use App\Http\Livewire\todayappointments;
use App\Http\Livewire\Reports\ClidocReport;
use App\Http\Livewire\Emergencies\Reception;
use App\Http\Controllers\Front\FormController;
use App\Http\Controllers\Front\GuestsController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Controllers\Front\PatientController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ReportsController;
use App\Http\Controllers\Front\VoucherController;
use App\Http\Controllers\Front\PatientsController;
use App\Http\Controllers\Front\TaxReturnController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\BankAccountsController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Livewire\AccountingDepartments;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () { //...

        Route::group(['middleware' => 'auth'], function () {
            Route::get('', function () {
                if (auth()->user()->isDoctor()) {
                    return redirect()->route('doctor.home');
                }
                if (auth()->user()->isScan()) {
                    return redirect()->route('scan.home');
                }
                if (auth()->user()->isLab()) {
                    return redirect()->route('lab.home');
                }
                return view('front.home');
            })->name('home');
            Route::view('/pregnant', 'front.pregnant.index')->name('pregnant');
            Route::get('pregnant/{pregnancy_category}', function ($pregnancy_category) {
                $pregnancy = PregnancyCategory::findOrFail($pregnancy_category);
                return view('front.pregnant.show', compact('pregnancy'));
            })->name('pregnant.show');

            Route::get('/guide', function () {
                $manuals = UserManual::get();
                return view('front.guide', compact('manuals'));
            })->name('guide');
            Route::view('/emergency', 'front.emergency.index')->name('emergency.index');
            Route::get('tax', [TaxReturnController::class, 'index'])->name('tax.index');

            Route::get('orthodontics/prescription/{orthodontic}', function (Orthodontic $orthodontic) {
                return view('front.patients.show-prescription', compact('orthodontic'));
            })->name('orthodontics.show_prescription');
            Route::view('interface', 'front.interface.index')->name('interface');
            Route::get('/patients/orthodontics/visits/{orthodontic}', [PatientsController::class, 'visits'])->name('patients.orthodontics.visits');
            Route::get('/patients/patientFile/{patient}', [PatientsController::class, 'patientFile'])->name('patientFile');
            Route::resource('patients', PatientsController::class);
            Route::get('appointments/{appointment}/show', [PatientsController::class, 'appointmentShow'])->name('patient.appointment');
            Route::post('appointments/{appointment}/presence', [AppointmentController::class, 'presence'])->name('appointments.presence');
            Route::post('appointments/{appointment}/notPresence', [AppointmentController::class, 'notPresence'])->name('appointments.notPresence');
            Route::resource('appointments', AppointmentController::class);
            Route::view('appointments-transferred', 'front.appointment.transferred')->name('appointment.transferred')->middleware('permission:transfered_appointments');
            Route::view('appointments-info', 'front.appointment.info')->name('appointments_info')->middleware('permission:read_appointments');
            Route::view('appointments-info-new', 'front.appointment.appointments-info')->name('appointments-info');
            Route::view('emergency-print', 'front.emergency-print')->name('emergency-print');
            /*Route::get('today_appointments', function () {
                $appoints = Appointment::where('appointment_date', date('Y-m-d'))->orderBy('appointment_time', 'asc')->get();
                return view('front.appointment.today_appointments', compact('appoints'));
            })->name('appointments.today_appointments')->middleware('permission:read_appointments');*/

            Route::view('today_appointments', 'front.appointment.today_appointments')->name('appointments.today_appointments')->middleware('permission:read_appointments');
            Route::view('suppliers','front.suppliers')->name('front.suppliers');
            Route::get('print-transferred/{appointment}', function (Appointment $appointment) {
                return view('front.patients.print-transfer', compact('appointment'));
            })->name('appointment.print-transfer')->middleware('permission:transfered_appointments');
            Route::resource('forms', FormController::class);
            Route::resource('invoices', InvoiceController::class);
            Route::get('all_bonds', [InvoiceController::class, 'all_bonds'])->name('invoices.all_bonds')->middleware('permission:read_invoices');
            Route::get('invoices/bonds/{invoice}', [InvoiceController::class, 'bonds'])->name('invoices.bonds');
            //Route::resource('reviews', ReviewController::class);
            Route::view('review', 'front.review.index')->name('review');

            Route::middleware('permission:read_reports')->group(function () {
                Route::get('/treasury', [ReportsController::class, 'treasury']);
                Route::view('accounting', 'front.accounting')->name('accounting');
                Route::view('/reports', 'front.reports')->name('reports');
                Route::view('treasuryAccount', 'front.reports.treasury-account')->name('treasury_account');
                Route::view('prescriptions', 'front.reports.prescriptions')->name('prescriptions');
                Route::view('patient-report', 'front.reports.patients')->name('patient_report');
                Route::view('clidoc-report', 'front.reports.clidoc-report')->name('Clidoc_report');
                Route::get('clidoc-report/export', [ClidocReport::class, 'export'])->name('Clidoc_report.export');
                Route::view('financial-report', 'front.reports.financial-report')->name('Financial_report');
                Route::view('offers-report', 'front.reports.offers')->name('offers_report');
                Route::view('products-report', 'front.reports.products')->name('products_report');
                Route::view('expenses-report', 'front.reports.expenses')->name('expenses_report');
                Route::view('purchases-report', 'front.reports.purchases')->name('purchases_report');
                Route::view('not-saudis-report', 'front.reports.not-sudies')->name('not_sudies');
                Route::view('insurances-report', 'front.reports.insurances-report')->name('insurances_report');
                Route::view('patient-groups-report', 'front.reports.patient-groups-report')->name('patient_groups_report');
                Route::view('installment-company-report', 'front.reports.installment-company')->name('installment_company');
                Route::view('reception-staff-report', 'front.reports.reception-staff-report')->name('reception_staff_report');
                Route::view('employee-discounts', 'front.reports.employee-discounts')->name('employee_discounts');
            });

            Route::view('/selectfilter', 'front.selectfilter')->name('selectfilter');
            // show-prescription
            Route::view('/show-prescription', 'front.patients.show-prescription')->name('show-prescription');


            Route::view('pay-visit', 'front.invoice.pay-visit')->name('pay_visit')->middleware('permission:pay_visit_invoices');
            Route::view('pay-plan', 'front.invoice.pay-plan')->name('pay_plan')->middleware('permission:pay_visit_invoices');
            Route::view('notifications', 'front.notifications')->name('notifications')->middleware('permission:read_notifications');
            Route::post('notifications/destroyAll', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
            Route::post('notifications/destroy/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
            Route::get('create/guest', [GuestsController::class, 'index'])->name('guests.create');
            //Profile Route
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('profile/vacations', [ProfileController::class, 'vacationRequest'])->name('profile.vacations');
            Route::post('profile/vacations', [ProfileController::class, 'vacationRequestStore'])->name('profile.vacation.store');
            //massage Route
            Route::get('/message', [MessageController::class, 'index'])->name('message');
            Route::post('/message', [MessageController::class, 'send'])->name('message.send');
            // Emergency reception
            Route::view('/emergency-reception', 'front.emergency.reception')->name('emergency.reception');
            Route::view('/patients-examination', 'front.emergency.patients-examination')->name('emergency.patients-examination');

            // Account statement
            Route::view('/account-statement', 'front.account-statement')->name('account-statement');
            // Voucher Report
            Route::view('/voucher-report', 'front.voucher-report')->name('voucher-report');

            Route::get('/vision-examination/{id}', function ($id) {
                $vision = VisionTest::with('dr')->findOrFail($id);
                return view('front.patients.show-screens.vision-examination', compact('vision'));
            })->name('vision-examination');

            Route::view('diagnoses', 'front.diagnoses.index')->name('diagnoses.index')->middleware('permission:read_diagnoses');
            Route::get('diagnoses/prescription/{diagnose}', function (Diagnose $diagnose) {
                return view('front.diagnoses.show-prescription', compact('diagnose'));
            })->name('diagnoses.show_prescription')->middleware('permission:read_diagnoses');

            Route::view('products', 'front.products.index')->name('products.index')->middleware('permission:read_products');
            Route::view('offers', 'front.offers.index')->name('offers.index')->middleware('permission:read_offers');
            // Route::view('doctors', 'front.doctors.index')->name('doctors.index');
            Route::view('salaries', 'front.salaries.index')->name('salaries.index');
            Route::view('departments', 'front.departments.index')->name('departments.index')->middleware('permission:read_departments');
            Route::view('patient_groups', 'front.patient_groups.index')->name('patient_groups.index')->middleware('permission:read_patient_groups');
            Route::get('patient_groups/{patient_group}', function (PatientGroup $patient_group) {
                return view('front.patient_groups.discounts', compact('patient_group'));
            })->name('patient_groups.discounts')->middleware('permission:read_patient_groups');
            Route::view('categories', 'front.categories.index')->name('categories.index');
            Route::view('expenses', 'front.expenses.index')->name('expenses.index')->middleware('permission:read_expenses');
            Route::view('purchases', 'front.purchases.index')->name('purchases.index')->middleware('permission:read_purchases');
            Route::view('scan_names', 'front.scan_names.index')->name('scan_names.index')->middleware('permission:read_scan_names');
            Route::view('marks', 'front.marks.index')->name('marks.index');
            Route::view('scan_lab_requests', 'front.scan_lab_requests')->name('scan_lab_requests');
            Route::resource('scan-requests', \App\Http\Controllers\Front\ScanRequestController::class);
            Route::view('lab-requests', 'front.requests.lab-requests')->name('lab_requests');
            Route::view('scan-requests', 'front.requests.scan-requests')->name('scan_requests');
            Route::view('x-rayRequests', 'front.x-rayRequests')->name('x-rayRequests');

            Route::get('showBonds/{bond}', function (InvoiceBond $bond) {


                //qr
                return view('front.invoice.showBonds', compact('bond'));
            })->name('showBonds')->middleware('permission:read_invoices');


            Route::get('program_modules', function () {
                $program_modules = ProgramModule::latest()->paginate(10);
                return view('front.program-additions', compact('program_modules'));
            })->name('program_modules');
        });

        Route::get('emergencies', Index::class)->name('emergencies');
        Route::get('emergencies/reception', Reception::class)->name('reception');

        Route::get('accounts-tree', Accounts::class)->name('accounts-tree');
        Route::get('accounts_settings', AccountingDepartments::class)->name('accounts_settings');

        Route::group(['middleware' => ['permission:create_cost_centers|read_cost_centers|update_cost_centers|delete_cost_centers']], function () {
            Route::view('cost_centers', 'front.cost_centers.index')->name('cost_centers');
            Route::get('cost_centers/{cost_center}', function (CostCenter $cost_center) {
                return view('front.cost_centers.show', compact('cost_center'));
            })->name('cost_centers.show');
        });

        Route::view('payment_methods', 'front.payment_methods.index')->name('payment_methods');

        Route::get('vouchers/report', [VoucherController::class, 'report'])->name('vouchers.report');
        Route::resource('vouchers', VoucherController::class);
        Route::resource('bank-accounts', BankAccountsController::class);

        Route::get('patients/{patient}/files', [PatientController::class, 'showPatientMedicalFiles'])->name('patients.medical')->middleware('permission:read_files');
        Route::post('patients/{patient}/files', [PatientController::class, 'storePatientMedicalFiles'])->name('patients.medical.store')->middleware('permission:create_files');
        Route::delete('medical/files/{file}/destroy', [PatientController::class, 'destroyPatientMedicalFile'])->name('patients.medical.destroy')->middleware('permission:delete_files');

        Route::view('our-services', 'front.our-services')->name('our-services');
    }

);
