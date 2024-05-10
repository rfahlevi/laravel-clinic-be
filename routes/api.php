<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ClinicServiceController;
use App\Http\Controllers\Api\MedicalRecordController;
use App\Http\Controllers\Api\PaymentDetailController;
use App\Http\Controllers\Api\DoctorScheduleController;
use App\Http\Controllers\Api\SatuSehatTokenController;
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

// Api Doctors
Route::apiResource('api-doctors', DoctorController::class)->middleware('auth:sanctum');

// Api Patients
Route::apiResource('api-patients', PatientController::class)->middleware('auth:sanctum');

// Api Doctor Schedules
Route::apiResource('api-doctor-schedules', DoctorScheduleController::class)->middleware('auth:sanctum');

// Api Clinic Services
Route::apiResource('api-clinic-services', ClinicServiceController::class)->middleware('auth:sanctum');

// Api Patient Reservations
Route::get('api-patient-reservations', [PatientReservationController::class, 'index'])->middleware('auth:sanctum');
Route::post('api-patient-reservations', [PatientReservationController::class, 'store'])->middleware('auth:sanctum');
Route::post('api-patient-reservations/cancel/{id}', [PatientReservationController::class, 'cancelReservationById'])->middleware('auth:sanctum');

// Api Medical Records
Route::get('api-medical-records', [MedicalRecordController::class, 'index'])->middleware('auth:sanctum');
Route::get('api-medical-records/{reservationId}', [MedicalRecordController::class, 'getByReservationId'])->middleware('auth:sanctum');
Route::post('api-medical-records', [MedicalRecordController::class, 'store'])->middleware('auth:sanctum');

// Api Payment Details
Route::get('api-payment-details', [PaymentDetailController::class, 'index'])->middleware('auth:sanctum');
Route::post('api-payment-details', [PaymentDetailController::class, 'store'])->middleware('auth:sanctum');

// Satu Sehat
Route::get('/satusehat-token', [SatuSehatTokenController::class, 'getToken'])->middleware('auth:sanctum');