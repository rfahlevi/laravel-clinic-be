<?php

namespace App\Http\Resources;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\ClinicService;
use Illuminate\Support\Carbon;
use App\Models\PatientReservation;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\ClinicServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PatientReservationResource;

class MedicalRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $patient = Patient::findOrFail($this->patient_id);
        $doctor = Doctor::findOrFail($this->doctor_id);
        $patientReservation = PatientReservation::findOrFail($this->patient_reservation_id);
        $medicalRecordServices = $this->medicalRecordServices;
        return [
            'id' => $this->id,
            'patient' => [
                'id' => $patient->id,
                'nik' => $patient->nik,
                'no_kk' => $patient->no_kk,
                'name' => $patient->name,
                'phone' => $patient->phone,
                'email' => $patient->email,
                'gender' => $patient->gender,
                'birth_place' => $patient->birth_place,
                'birth_date' => $patient->birth_date,
                'address_line' => $patient->address_line,
                'city' => $patient->city,
                'city_code' => $patient->city_code,
                'province' => $patient->province,
                'province_code' => $patient->province_code,
                'district' => $patient->district,
                'district_code' => $patient->district_code,
                'village' => $patient->village,
                'village_code' => $patient->village_code,
                'rt' => $patient->rt,
                'rw' => $patient->rw,
                'postal_code' => $patient->postal_code,
                'marital_status' => $patient->marital_status,
                'relationship_name' => $patient->relationship_name,
                'relationship_phone' => $patient->relationship_phone,
                'is_deceased' => $patient->is_deceased,
            ],
            'doctor' => [
                'id' => $doctor->id,
                'id_ihs' => $doctor->id_ihs,
                'nik' => $doctor->nik,
                'sip' => $doctor->sip,
                'name' => $doctor->name,
                'specialization' => $doctor->specialization,
                'phone' => $doctor->phone,
                'email' => $doctor->email,
                'photo' => $doctor->photo,
                'address' => $doctor->address,
            ],
            'patient_reservation' => [
                'id' => $patientReservation->id,
                'schedule_time' => $patientReservation->schedule_time,
                'complaint' => $patientReservation->complaint,
                'queue_number' => $patientReservation->queue_number,
                'status' => $patientReservation->status,
                'payment_method' => $patientReservation->payment_method,
                'total_price' => $patientReservation->total_price,
            ],
            'diagnosis' => $this->diagnosis,
            'medical_treatment' => $this->medical_treatment,
            'doctor_notes' => $this->doctor_notes,
            'medical_record_services' => $medicalRecordServices->map(function ($medicalRecordService) {
                return [
                    'id' => $medicalRecordService->id,
                    'clinic_service' => new ClinicServiceResource(ClinicService::findOrFail($medicalRecordService->clinic_service_id)),
                    'qty' => $medicalRecordService->qty
                ];
            }),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s') 
        ];
    }
}
