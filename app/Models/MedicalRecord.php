<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientReservation;
use App\Models\MedicalRecordService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the patient that owns the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    /**
     * Get the doctor that owns the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get all of the medicalRecordServices for the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalRecordServices(): HasMany
    {
        return $this->hasMany(MedicalRecordService::class);
    }

    /**
     * Get the patientReservation that owns the MedicalRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patientReservation(): BelongsTo
    {
        return $this->belongsTo(PatientReservation::class);
    }
}
