<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PatientReservation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PatientReservationResource;

class PatientReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reservations = PatientReservation::with('patient', 'doctor')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data reservasi',
                'data' => PatientReservationResource::collection($reservations),
            ],
            200,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'schedule_time' => 'required',
            'complaint' => 'required',
        ];

        $messages = [
            'patient_id.required' => 'Pilih pasien terlebih dahulu',
            'doctor_id.required' => 'Pilih dokter terlebih dahulu',
            'schedule_time.required' => 'Waktu reservasi harus diisi',
            'complaint.required' => 'Isi keluhan terlebih dahulu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ], 422);
        }

        $data = $validator->validated();
        
        $newRerservation = PatientReservation::create([
            'patient_id' => $data['patient_id'],
            'doctor_id' => $data['doctor_id'],
            'schedule_time' => $data['schedule_time'],
            'complaint' => $data['complaint'],
            'status' => 'Menunggu',
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'Berhasil membuat reservasi',
            'data' => new PatientReservationResource($newRerservation),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
