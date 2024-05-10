<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PaymentDetailResource;

class PaymentDetailController extends Controller
{
    public function index(Request $request)
    {
        $paymentDetails = PaymentDetail::with('patientReservation')
            ->when($request->input('payment'), function ($query, $name) {
                return $query->whereHas('patientReservation.patient', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%')->orWhere('nik', 'like', '%' . $name . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data Payment Details',
                'data' => PaymentDetailResource::collection($paymentDetails),
            ],
            200,
        );
    }

    public function store(Request $request)
    {
        $rules = [
            'patient_reservation_id' => 'required|exists:patient_reservations,id',
            'payment_method' => 'required',
            'total_price' => 'required',
        ];

        $messages = [
            'patient_reservation_id.*' => 'Reservasi tidak teridentifikasi',
            'payment_method.required' => 'Metode pembayaran tidak teridentifikasi',
            'total_price.required' => 'Total harga tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ], 422);
        }

        $validated = $validator->validated();

        // Store payment detail
        $paymentDetail = PaymentDetail::create($validated);

        // Update patient reservation status, payment method and total price
        $patientReservation = $paymentDetail->patientReservation;
        $patientReservation->update([
            'status' => 'Selesai',
            'payment_method' => $paymentDetail->payment_method,
            'total_price' => $paymentDetail->total_price,
        ]);

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil membuat data payment',
                'data' => new PaymentDetailResource($paymentDetail),
            ], 201
        );
    }
}
