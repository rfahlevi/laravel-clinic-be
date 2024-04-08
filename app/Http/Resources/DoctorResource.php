<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'id_ihs' => $this->id_ihs,
            'nik' => $this->nik,
            'sip' => $this->sip,
            'name' => $this->name,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'email' => $this->email,
            'photo' => $this->photo,
            'address' => $this->address,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
