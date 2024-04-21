<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ClinicServiceController;
use App\Http\Controllers\Api\DoctorScheduleController;
use App\Http\Controllers\Api\PatientReservationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::apiResource('api-doctors', DoctorController::class)->middleware('auth:sanctum');
Route::apiResource('api-patients', PatientController::class)->middleware('auth:sanctum');
Route::apiResource('api-doctor-schedules', DoctorScheduleController::class)->middleware('auth:sanctum');
Route::apiResource('api-clinic-services', ClinicServiceController::class)->middleware('auth:sanctum');
Route::apiResource('api-patient-reservations', PatientReservationController::class)->middleware('auth:sanctum');