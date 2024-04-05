<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            ->paginate(10);

        return view('pages.doctor_schedule.index', [
            'type_menu' => 'schedule',
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('pages.doctor_schedule.create', [
            'type_menu' => 'schedule',
            'doctors' => $doctors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'doctor_id' => 'required',
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
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        if (!empty($request->doctor_id) && empty($request->senin_start) && empty($request->senin_end) && empty($request->selasa_start) && empty($request->selasa_end) && empty($request->rabu_start) && empty($request->rabu_end) && empty($request->kamis_start) && empty($request->kamis_end) && empty($request->jumat_start) && empty($request->jumat_end) && empty($request->sabtu_start) && empty($request->sabtu_end) && empty($request->minggu_start) && empty($request->minggu_end)) {
            return redirect()->back()->withErrors('Minimal 1 jadwal harus diisi')->withInput();
        }

        if($request->senin_start && $request->senin_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->senin_start;
            $schedule->end = $request->senin_end;
            $schedule->day = 'Senin';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->selasa_start && $request->selasa_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->selasa_start;
            $schedule->end = $request->selasa_end;
            $schedule->day = 'Selasa';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->rabu_start && $request->rabu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->rabu_start;
            $schedule->end = $request->rabu_end;
            $schedule->day = 'Rabu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->kamis_start && $request->kamis_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->kamis_start;
            $schedule->end = $request->kamis_end;
            $schedule->day = 'Kamis';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->jumat_start && $request->jumat_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->jumat_start;
            $schedule->end = $request->jumat_end;
            $schedule->day = "Jum'at";
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->sabtu_start && $request->sabtu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->sabtu_start;
            $schedule->end = $request->sabtu_end;
            $schedule->day = 'Sabtu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

         if($request->minggu_start && $request->minggu_end) {
            $schedule = new DoctorSchedule();
            $schedule->doctor_id = $request->doctor_id;
            $schedule->start = $request->minggu_start;
            $schedule->end = $request->minggu_end;
            $schedule->day = 'Minggu';
            $schedule->status = $request->status;
            $schedule->note = $request->note;
            $schedule->save();
        }

        return redirect(route('schedules.index'))->with('success', 'Berhasil menambahkan jadwal');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $doctors = Doctor::orderBy('name')->get();
        return view('pages.doctor_schedule.edit', [
            'type_menu' => 'schedule',
            'schedule' => $schedule,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $schedule->doctor_id = $request->doctor_id;
        $schedule->start = trim($request->start);
        $schedule->end = trim($request->end);
        $schedule->day = trim($schedule->day);
        $schedule->status = trim($request->status);
        $schedule->note = trim($request->note);
        $schedule->save();

        return redirect(route('schedules.index'))->with('success', 'Berhasil mengubah jadwal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->delete();

        return redirect(route('schedules.index'))->with('success', 'Berhasil mengahapus jadwal');
    }
}
