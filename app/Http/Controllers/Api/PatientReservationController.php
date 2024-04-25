<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PatientReservation;
use Illuminate\Support\Facades\DB;
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
        $reservations = DB::table('patient_reservations')
        ->leftJoin('patients as p', 'patient_reservations.patient_id', '=', 'p.id')
        ->leftJoin('doctors as d', 'patient_reservations.doctor_id', '=', 'd.id')
        ->select('patient_reservations.*', 'p.*', 'd.*');

         if (!empty($request->patient)) {
            $reservations = $reservations->where('p.nik', 'like', '%' . $request->patient . '%')
            ->orWhere('p.name', 'like', '%' . $request->patient . '%');
        }

        $reservations = $reservations->orderBy('patient_reservations.queue_number')->get();

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
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_time' => 'required',
            'complaint' => 'required',
            'queue_number' => 'required',
            'payment_method' => 'nullable',
            'total_price' => 'nullable',
        ];

        $messages = [
            'patient_id.&' => 'Pasien tidak teridentifikasi',
            'doctor_id.&' => 'Dokter tidak teridentifikasi',
            'schedule_time.required' => 'Waktu reservasi harus diisi',
            'complaint.required' => 'Isi keluhan terlebih dahulu',
            'queue_number.required' => 'Gagal mendapatkan nomor antrian',
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
            'queue_number' => $data['queue_number'],
            'payment_method' => $data['payment_method'] ?? 'Tunai',
            'total_price' => 0,
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
