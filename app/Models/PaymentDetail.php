<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\PatientReservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the patientReservation that owns the PaymentDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patientReservation(): BelongsTo
    {
        return $this->belongsTo(PatientReservation::class);
    }
}
