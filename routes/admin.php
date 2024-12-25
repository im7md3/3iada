<?php

use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Marketers;
use App\Http\Livewire\Admin\ConstSettings;
use App\Http\Livewire\Admin\Messages\Text;
use App\Http\Controllers\Admin\LabCategory;
use App\Http\Livewire\Admin\Messages\Image;
use App\Http\Controllers\Admin\LabController;
use App\Http\Livewire\Admin\VacationRequests;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Livewire\Admin\SendMessageSettings;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Livewire\Admin\Messages\SendMessage;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Livewire\Admin\Messages\MessagesSent;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SmsMessageController;
use App\Http\Controllers\Admin\UserManualController;
use App\Http\Controllers\Admin\ScanServiceController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\RelationshipController;
use App\Http\Controllers\Admin\ProgramModuleController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::view('admin/login', 'admin.login')->middleware('admin_guest')->name('admin.login');
Route::view('admin/login', 'admin.login')->middleware('admin_guest')->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->middleware('admin_guest')->name('admin.login.post');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::view('/', 'admin.home')->name('home');
            Route::view('/control', 'admin.control')->name('control');
            // Route::get('test', function () {
            //     $invoices = Invoice::where('status', 'Paid')->where('dr_id', 3)->get();
            //     foreach ($invoices as $invoice) {
            //         // if ((($invoice->amount - $invoice->discount) - $invoice->offers_discount + $invoice->tax) != $invoice->total && !in_array($invoice->id, [45])) {
            //         if ($invoice->paid > $invoice->total) {
            //             dd($invoice);
            //         }
            //     }
            //     dd('nothing');
            // });
            Route::view('settings', 'admin.settings')->name('settings')->middleware('permission:read_settings');
            Route::post('settings', [SettingsController::class, 'settings'])->name('settings.update')->middleware('permission:update_settings');
            Route::get('profile', [ProfileController::class, 'show'])->name('profile');
            Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::resource('departments', DepartmentController::class);
            Route::resource('relationships', RelationshipController::class);
            Route::resource('cities', CityController::class);
            Route::resource('marks', MarkController::class);
            Route::get('/prescriptions/export', [PrescriptionController::class, 'export'])->name('prescriptions.export');
            Route::post('/prescriptions/import', [PrescriptionController::class, 'import'])->name('prescriptions.import');
            Route::resource('prescriptions', PrescriptionController::class);




            Route::resource('countries', CountryController::class);
            Route::resource('users', UsersController::class);
            Route::resource('patients', PatientsController::class);
            Route::resource('forms', FormController::class);
            Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class)->only('index', 'show');
            Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class)->only('index', 'show');
            Route::resource('diagnoses', \App\Http\Controllers\Admin\DiagnosesController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('products', ProductController::class);
            Route::resource('insurances', InsuranceController::class);
            Route::resource('labs', LabController::class);
            Route::resource('lab-categories', LabCategory::class);
            Route::resource('scan-services', ScanServiceController::class);
            Route::resource('user-manuals', UserManualController::class);
            //MASSAGE ROUTE
            Route::get('massage', [MessageController::class, 'setting'])->name('massage.index');
            Route::post('/message/settings', [MessageController::class, 'settingStore'])->name('message.setting.store');

            Route::resource('sms_messages', SmsMessageController::class);

            Route::resource('services', ServiceController::class);

            Route::resource('program_modules', ProgramModuleController::class);
            Route::get('vacations', VacationRequests::class)->name('vacations');
            // Route::view('/mark', 'admin.mark.index')->name('mark.index');
            // Route::view('/mark/create', 'admin.mark.create')->name('mark.create');
            Route::get('const', ConstSettings::class)->name('const');
            // Route::view('/prescription', 'admin.prescription')->name('prescription');
            Route::resource('branches', BranchController::class);
            Route::get('marketers', Marketers::class)->name('marketers');
            Route::get('message_library/text_message', Text::class)->name('message_library.texts');
            Route::get('message_library/images_message', Image::class)->name('message_library.images');
            Route::get('message_library/send_message', SendMessage::class)->name('message_library.send_message');
            Route::get('message_library/sent_messages', MessagesSent::class)->name('message_library.sent_messages');
            Route::get('message_library/messages_settings', SendMessageSettings::class)->name('message_library.send_message_settings');
        });
    }
);
