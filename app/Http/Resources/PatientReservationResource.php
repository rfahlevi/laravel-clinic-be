<?php

namespace App\Http\Resources;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient' => new PatientResource(Patient::findOrFail($this->patient_id)),
            'doctor' => new DoctorResource(Doctor::findOrFail($this->doctor_id)),
            'schedule_time' => $this->schedule_time,
            'complaint' => $this->complaint,
            'queue_number' => $this->queue_number,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'total_price' => $this->total_price,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
