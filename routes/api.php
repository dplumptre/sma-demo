<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/getinfo',[App\Http\Controllers\ApiController::class, 'getInfo'] );


 // GET    api/classrooms                           
 // POST   api/classrooms
 // SHOW    api/classrooms/{classroom}

Route::resource('/classrooms',App\Http\Controllers\ClassroomController::class);
Route::resource('/students',App\Http\Controllers\StudentController::class);
Route::resource('/payments',App\Http\Controllers\PaymentController::class);
// This route below checks if a student has paid or not
Route::prefix('payments')->group(function () {  
     Route::get('student/{student}/{classroom}', [App\Http\Controllers\PaymentController::class, 'getStudentPayment']);
    
});

