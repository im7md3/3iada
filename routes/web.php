<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BackupController;

require __DIR__ . '/admin.php';

//  Route::get('{any}', function() {
//     return redirect()->route('admin.login');
// })->where('any', '.*');

Route::get('backup-database', [BackupController::class, 'backupDatabase'])->name('backup-database');

require_once __DIR__ . '/fortify.php';

// Route::get('test', function () {
//     Artisan::call('appointments:send');
// });


// 419 Error Page
Route::view('admin/419Error', 'errors.419')
    ->name('419Error');


