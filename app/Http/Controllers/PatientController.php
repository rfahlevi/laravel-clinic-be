<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients = DB::table('patients');

        if (!empty($request->patient)) {
            $patients = $patients->where('nik', 'like', '%' . $request->patient . '%')->orWhere('name', 'like', '%' . $request->patient . '%');
        }

        $patients = $patients->orderBy('name')->paginate(10);

        return view('pages.patient.index', [
            'type_menu' => 'patient',
            'patients' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.patient.create', [
            'type_menu' => 'patient',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nik' => 'required|unique:patients,nik,',
            'no_kk' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'village' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'postal_code' => 'required',
            'marital_status' => 'required',
            'is_deceased' => 'required',
        ];

        $messages = [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'no_kk.required' => 'Nomor KK tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'gender.required' => 'Jenis kelamin tidak boleh kosong',
            'birth_place.required' => 'Tempat lahir tidak boleh kosong',
            'birth_date.required' => 'Tanggal lahir tidak boleh kosong',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
            'address_line.required' => 'Alamat tidak boleh kosong',
            'city.required' => 'Kota tidak boleh kosong',
            'province.required' => 'Provinsi tidak boleh kosong',
            'district.required' => 'Kecamatan tidak boleh kosong',
            'village.required' => 'Kelurahan tidak boleh kosong',
            'rt.required' => 'RT tidak boleh kosong',
            'rw.required' => 'RW tidak boleh kosong',
            'postal_code.required' => 'Kode pos tidak boleh kosong',
            'marital_status.required' => 'Status perkawinan tidak boleh kosong',
            'is_deceased.required' => 'Status kematian tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $newPatient = $validator->validated();

        Patient::create([
            'nik' => $newPatient['nik'],
            'no_kk' => $newPatient['no_kk'],
            'name' => $newPatient['name'],
            'phone' => $newPatient['phone'],
            'email' => $newPatient['email'],
            'gender' => $newPatient['gender'],
            'birth_place' => $newPatient['birth_place'],
            'birth_date' => $newPatient['birth_date'],
            'address_line' => $newPatient['address_line'],
            'city' => $newPatient['city'],
            'city_code' => random_int(1, 100),
            'province' => $newPatient['province'],
            'province_code' => random_int(1, 100),
            'district' => $newPatient['district'],
            'district_code' => random_int(1, 100),
            'village' => $newPatient['village'],
            'village_code' => random_int(1, 100),
            'rt' => $newPatient['rt'],
            'rw' => $newPatient['rw'],
            'postal_code' => $newPatient['postal_code'],
            'marital_status' => $newPatient['marital_status'],
            'is_deceased' => 0,
        ]);

        return redirect(route('patients.index'))->with('success', 'Berhasil menambahkan pasien : ' . $newPatient['name']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return view('pages.patient.show', [
            'type_menu' => 'patient',
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('pages.patient.edit', [
            'type_menu' => 'patient',
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $rules = [
            'nik' => 'required|unique:patients,nik,' . $id,
            'no_kk' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'district' => 'required',
            'village' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'postal_code' => 'required',
            'marital_status' => 'required',
            'is_deceased' => 'required',
        ];

        $messages = [
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'no_kk.required' => 'Nomor KK tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'gender.required' => 'Jenis kelamin tidak boleh kosong',
            'birth_place.required' => 'Tempat lahir tidak boleh kosong',
            'birth_date.required' => 'Tanggal lahir tidak boleh kosong',
            'birth_date.date' => 'Format tanggal lahir tidak valid',
            'address_line.required' => 'Alamat tidak boleh kosong',
            'city.required' => 'Kota tidak boleh kosong',
            'province.required' => 'Provinsi tidak boleh kosong',
            'district.required' => 'Kecamatan tidak boleh kosong',
            'village.required' => 'Kelurahan tidak boleh kosong',
            'rt.required' => 'RT tidak boleh kosong',
            'rw.required' => 'RW tidak boleh kosong',
            'postal_code.required' => 'Kode pos tidak boleh kosong',
            'marital_status.required' => 'Status perkawinan tidak boleh kosong',
            'is_deceased.required' => 'Status kematian tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $validated = $validator->validated();
        $patient->nik = $validated['nik'];
        $patient->no_kk = $validated['no_kk'];
        $patient->name = $validated['name'];
        $patient->phone = $validated['phone'];
        $patient->email = $validated['email'];
        $patient->gender = $validated['gender'];
        $patient->birth_place = $validated['birth_place'];
        $patient->birth_date = $validated['birth_date'];
        $patient->address_line = $validated['address_line'];
        $patient->city = $validated['city'];
        $patient->province = $validated['province'];
        $patient->district = $validated['district'];
        $patient->village = $validated['village'];
        $patient->rt = $validated['rt'];
        $patient->rw = $validated['rw'];
        $patient->postal_code = $validated['postal_code'];
        $patient->marital_status = $validated['marital_status'];
        $patient->is_deceased = $validated['is_deceased'] == 'Hidup' ? 0 : 1;
        $patient->save();

        return redirect(route('patients.index'))->with('success', 'Berhasil mengubah pasien : ' . $patient->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();

        return redirect(route('patients.index'))->with('success', 'Berhasil mengahapus pasien : ' . $patient->name);
    }
}
