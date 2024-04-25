<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DoctorScheduleResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schedules = DB::table('doctor_schedules as s')
            ->leftJoin('doctors as d', 's.doctor_id', '=', 'd.id')
            ->select('s.*', 'd.name as doctor_name', 'd.sip as doctor_sip', 'd.specialization as doctor_specialization')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('d.name', 'like', '%' . $name . '%');
            })
            ->orderBy('name')
            ->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data schedule',
                'data' => DoctorScheduleResource::collection($schedules),
            ],
            200,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'doctor_id' => 'required|exists:doctors,id',
            'senin_start' => 'required_with:senin_end',
            'senin_end' => 'required_with:senin_start',
            'selasa_start' => 'required_with:selasa_end',
            'selasa_end' => 'required_with:selasa_start',
            'rabu_start' => 'required_with:rabu_end',
            'rabu_end' => 'required_with:rabu_start',
            'kamis_start' => 'required_with:kamis_end',
            'kamis_end' => 'required_with:kamis_start',
            'jumat_start' => 'required_with:jumat_end',
            'jumat_end' => 'required_with:jumat_start',
            'sabtu_start' => 'required_with:sabtu_end',
            'sabtu_end' => 'required_with:sabtu_start',
            'minggu_start' => 'required_with:minggu_end',
            'minggu_end' => 'required_with:minggu_start',
        ];

        $messages = [
            'doctor_id.required' => 'Pilih dokter terlebih dahulu',
            'senin_start.required_with' => 'Waktu mulai jadwal senin harus diisi',
            'senin_end.required_with' => 'Waktu selesai jadwal senin harus diisi',
            'selasa_start.required_with' => 'Waktu mulai jadwal selasa harus diisi',
            'selasa_end.required_with' => 'Waktu selesai jadwal selasa harus diisi',
            'rabu_start.required_with' => 'Waktu mulai jadwal rabu harus diisi',
            'rabu_end.required_with' => 'Waktu selesai jadwal rabu harus diisi',
            'kamis_start.required_with' => 'Waktu mulai jadwal kamis harus diisi',
            'kamis_end.required_with' => 'Waktu selesai jadwal kamis harus diisi',
            'jumat_start.required_with' => 'Waktu mulai jadwal jumat harus diisi',
            'jumat_end.required_with' => 'Waktu selesai jadwal jumat harus diisi',
            'sabtu_start.required_with' => 'Waktu mulai jadwal sabtu harus diisi',
            'sabtu_end.required_with' => 'Waktu selesai jadwal sabtu harus diisi',
            'minggu_start.required_with' => 'Waktu mulai jadwal minggu harus diisi',
            'minggu_end.required_with' => 'Waktu selesai jadwal minggu harus diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ],
                422,
            );
        }

        if (!empty($request->doctor_id) && empty($request->senin_start) && empty($request->senin_end) && empty($request->selasa_start) && empty($request->selasa_end) && empty($request->rabu_start) && empty($request->rabu_end) && empty($request->kamis_start) && empty($request->kamis_end) && empty($request->jumat_start) && empty($request->jumat_end) && empty($request->sabtu_start) && empty($request->sabtu_end) && empty($request->minggu_start) && empty($request->minggu_end)) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Minimal 1 jadwal harus diisi',
                ],
                400,
            );
        }

        if ($request->senin_start && $request->senin_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->senin_start;
            $schedule->end = $request->senin_end;
            $schedule->day = 'Senin';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->selasa_start && $request->selasa_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->selasa_start;
            $schedule->end = $request->selasa_end;
            $schedule->day = 'Selasa';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->rabu_start && $request->rabu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->rabu_start;
            $schedule->end = $request->rabu_end;
            $schedule->day = 'Rabu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->kamis_start && $request->kamis_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->kamis_start;
            $schedule->end = $request->kamis_end;
            $schedule->day = 'Kamis';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->jumat_start && $request->jumat_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->jumat_start;
            $schedule->end = $request->jumat_end;
            $schedule->day = "Jum'at";
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->sabtu_start && $request->sabtu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->sabtu_start;
            $schedule->end = $request->sabtu_end;
            $schedule->day = 'Sabtu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        if ($request->minggu_start && $request->minggu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->minggu_start;
            $schedule->end = $request->minggu_end;
            $schedule->day = 'Minggu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        // Untuk test Postman
        //  $schedule = new DoctorSchedule();
        //     $schedule->doctor_id = $request->doctor_id;
        //     $schedule->start = $request->start;
        //     $schedule->end = $request->end;
        //     $schedule->day = 'Minggu';
        //     $schedule->status = $request->status;
        //     $schedule->note = $request->note;
        //     $schedule->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil membuat jadwal dokter',
                'data' => new DoctorScheduleResource($schedule),
            ],
            201,
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $schedule = DoctorSchedule::findOrFail($id);

            $rules = [
                'doctor_id' => 'required',
                'start' => 'required',
                'end' => 'required',
                'status' => 'required',
            ];

            $messages = [
                'doctor_id.required' => 'Pilih dokter terlebih dahulu',
                'start.required' => 'Waktu mulai harus diisi',
                'end.required' => 'Waktu selesai harus diisi',
                'status.required' => 'Status harus dipilih',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => $validator->messages()->first(),
                    ],
                    422,
                );
            }

            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = trim($request->start);
            $schedule->end = trim($request->end);
            $schedule->day = trim($schedule->day);
            $schedule->status = trim($request->status);
            $schedule->note = trim($request->note);
            $schedule->save();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil mengupdate jadwal dokter',
                    'data' => new DoctorScheduleResource($schedule),
                ],
                200,
            );
        } catch (ModelNotFoundException $error) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data schedule tidak ditemukan',
                ],
                404,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $schedule = DoctorSchedule::findOrFail($id);
            $schedule->delete();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil mengahapus jadwal dokter',
                ],
                200,
            );
        } catch (ModelNotFoundException $err) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data schedule tidak ditemukan',
                ],
                404,
            );
        }
    }
}
