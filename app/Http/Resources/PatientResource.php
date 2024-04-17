<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $table->id();
        //     $table->string('nik');
        //     $table->string('no_kk');
        //     $table->string('name');
        //     $table->string('phone');
        //     $table->string('email')->nullable();
        //     $table->enum('gender', ['Pria', 'Wanita'])->default('Pria');
        //     $table->string('birth_place');
        //     $table->date('birth_date');
        //     $table->text('address_line');
        //     $table->string('city');
        //     $table->string('city_code');
        //     $table->string('province');
        //     $table->string('province_code');
        //     $table->string('district');
        //     $table->string('district_code');
        //     $table->string('village');
        //     $table->string('village_code');
        //     $table->string('rt');
        //     $table->string('rw');
        //     $table->string('postal_code');
        //     $table->enum('marital_status', ['Belum Menikah', 'Menikah', 'Cerai'])->default('Belum Menikah');
        //     $table->string('relationship_name')->nullable();
        //     $table->string('relationship_phone')->nullable();
        //     $table->boolean('is_deceased')->default(false);
        return [
            'id' => $this->id,
            'nik' => $this->nik,
            'no_kk' => $this->no_kk,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'address_line' => $this->address_line,
            'city' => $this->city,
            'city_code' => $this->city_code,
            'province' => $this->province,
            'province_code' => $this->province_code,
            'district' => $this->district,
            'district_code' => $this->district_code,
            'village' => $this->village,
            'village_code' => $this->village_code,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'marital_status' => $this->marital_status,
            'relationship_name' => $this->relationship_name,
            'relationship_phone' => $this->relationship_phone,
            'is_deceased' => $this->is_deceased,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
