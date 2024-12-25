<?php

use App\Http\Controllers\API\AppointmentController;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('orders',OrdersController::class);

Route::get('api/accounts/parents',function(){
    $accounts = Account::where(function($q){
        if($keyword = request()->get('keyword')){
            $q->where('name','LIKE',"%$keyword%");
        }
    })->whereNull('parent_id')->get();

    return response()->json($accounts);
});

Route::get('api/appointments-info',[AppointmentController::class , 'index']);
