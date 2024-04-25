<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PatientReservation;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PatientReservationResource;

class PaymentDetailResource extends JsonResource
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
            'patient_reservation' => new PatientReservationResource(PatientReservation::findOrFail($this->patient_reservation_id)),
            'payment_method' => $this->payment_method,
            'total_price' => $this->total_price,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),    
        ];
    }
}
