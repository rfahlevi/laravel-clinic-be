<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ClinicService;
use App\Models\MedicalRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MedicalRecordResource;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $records = MedicalRecord::with('doctor', 'patient', 'medicalRecordServices', 'patientReservation')
            ->when($request->input('record'), function ($query, $record) {
                return $query->whereHas('patient', function ($query) use ($record) {
                    $query->where('name', 'like', '%' . $record . '%')->orWhere('nik', 'like', '%' . $record . '%');
                });
            })
            ->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data Medical Records',
                'data' => MedicalRecordResource::collection($records),
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
            'patient_reservation_id' => 'required|exists:patient_reservations,id',
            'diagnosis' => 'required',
            'medical_treatment' => 'nullable',
            'doctor_notes' => 'nullable',
            'medical_record_services' => 'required|array',
        ];

        $messages = [
            'patient_id.*' => 'Pasien tidak teridentifikasi',
            'doctor_id.*' => 'Dokter tidak teridentifikasi',
            'patient_reservation_id.*' => 'Reservasi tidak teridentifikasi',
            'diagnosis.required' => 'Diagnosis tidak boleh kosong',
            'medical_record_services.required' => 'Layanan klinik tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ], 422);
        }

        $validated = $validator->validated();
        $totalPrice = 0;

        // Store Medical Record
        $medicalRecord = MedicalRecord::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'patient_reservation_id' => $validated['patient_reservation_id'],
            'diagnosis' => $validated['diagnosis'],
            'medical_treatment' => $validated['medical_treatment'],
            'doctor_notes' => $validated['doctor_notes'],
        ]);

        // Store Medical Record Services
        foreach ($validated['medical_record_services'] as $service) {
            $medicalRecord->medicalRecordServices()->create([
                'medical_record_id' => $medicalRecord->id,
                'clinic_service_id' => $service['clinic_service_id'],
                'qty' => $service['qty'],
            ]);
            $totalPrice += ClinicService::findOrFail($service['clinic_service_id'])->price;
        }

        // Update Patient Reservation Status
        $patientReservation = $medicalRecord->patientReservation;
        $patientReservation->status = 'Proses';
        $patientReservation->total_price = $totalPrice;
        $patientReservation->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil membuat Medical Record baru',
                'data' => new MedicalRecordResource($medicalRecord),
            ],
            201,
        );
    }

    public function getByReservationId($reservationId)
    {
        $medicalRecords = MedicalRecord::where('patient_reservation_id', $reservationId)->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data Medical Records',
                'data' => MedicalRecordResource::collection($medicalRecords),
            ],
            200,
        );
    }
}
