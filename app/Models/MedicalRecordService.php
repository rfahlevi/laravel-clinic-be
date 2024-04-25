<?php

namespace App\Models;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecordService extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

     /**
     * Get the medicalRecord that owns the ClinicService
     *
     * @return BelongsTo
     */
    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
