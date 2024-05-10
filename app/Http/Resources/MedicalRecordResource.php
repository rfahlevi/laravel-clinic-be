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
        $patientReservation = PatientReservation::findOrFail($this->patient_reservation_id);
        $medicalRecordServices = $this->medicalRecordServices;
        return [
            'id' => $this->id,
            'patient_reservation' => new PatientReservationResource($patientReservation),
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
