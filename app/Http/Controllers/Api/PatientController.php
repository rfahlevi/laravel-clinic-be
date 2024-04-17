<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data pasien',
                'data' => PatientResource::collection($patients),
                'current_page' => $patients->currentPage(),
                'last_page' => $patients->lastPage(),
                'total' => $patients->total(),
            ],
            200,
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
                'city_code' => 'required',
                'province' => 'required',
                'province_code' => 'required',
                'district' => 'required',
                'district_code' => 'required',
                'village' => 'required',
                'village_code' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'postal_code' => 'required',
                'marital_status' => 'required',
                'is_deceased' => 'required',
                'relationship_name' => 'nullable',
                'relationship_phone' => 'nullable',
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
                'city_code.required' => 'Kota tidak boleh kosong',
                'province.required' => 'Provinsi tidak boleh kosong',
                'province_code.required' => 'Provinsi tidak boleh kosong',
                'district.required' => 'Kecamatan tidak boleh kosong',
                'district_code.required' => 'Kecamatan tidak boleh kosong',
                'village.required' => 'Kelurahan tidak boleh kosong',
                'village_code.required' => 'Kelurahan tidak boleh kosong',
                'rt.required' => 'RT tidak boleh kosong',
                'rw.required' => 'RW tidak boleh kosong',
                'postal_code.required' => 'Kode pos tidak boleh kosong',
                'marital_status.required' => 'Status perkawinan tidak boleh kosong',
                'is_deceased.required' => 'Status kematian tidak boleh kosong',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->messages()->first(),
                ],422);
            }

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
                'city_code' => $newPatient['city_code'],
                'province' => $newPatient['province'],
                'province_code' => $newPatient['province_code'],
                'district' => $newPatient['district'],
                'district_code' => $newPatient['district_code'],
                'village' => $newPatient['village'],
                'village_code' => $newPatient['village_code'],
                'rt' => $newPatient['rt'],
                'rw' => $newPatient['rw'],
                'postal_code' => $newPatient['postal_code'],
                'marital_status' => $newPatient['marital_status'],
                'is_deceased' => $newPatient['is_deceased'],
                'relationship_name' => $newPatient['relationship_name'],
                'relationship_phone' => $newPatient['relationship_phone'],
            ]);

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil menambahkan pasien baru',
                    'data' => new PatientResource(Patient::where('nik', $newPatient['nik'])->first()),
                ],
                201,
            );
        } catch (ModelNotFoundException $error) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Gagal menambahkan pasien baru',
                ],
                404,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $patient = Patient::findOrFail($id);

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Data pasien ditemukan',
                    'data' => new PatientResource($patient),
                ],
                200,
            );
        } catch (ModelNotFoundException $error) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data pasien tidak ditemukan',
                ],
                404,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
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
                'city_code' => 'required',
                'province' => 'required',
                'province_code' => 'required',
                'district' => 'required',
                'district_code' => 'required',
                'village' => 'required',
                'village_code' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'postal_code' => 'required',
                'marital_status' => 'required',
                'is_deceased' => 'required',
                'relationship_name' => 'nullable',
                'relationship_phone' => 'nullable',
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
                'city_code.required' => 'Kota tidak boleh kosong',
                'province.required' => 'Provinsi tidak boleh kosong',
                'province_code.required' => 'Provinsi tidak boleh kosong',
                'district.required' => 'Kecamatan tidak boleh kosong',
                'district_code.required' => 'Kecamatan tidak boleh kosong',
                'village.required' => 'Kelurahan tidak boleh kosong',
                'village_code.required' => 'Kelurahan tidak boleh kosong',
                'rt.required' => 'RT tidak boleh kosong',
                'rw.required' => 'RW tidak boleh kosong',
                'postal_code.required' => 'Kode pos tidak boleh kosong',
                'marital_status.required' => 'Status perkawinan tidak boleh kosong',
                'is_deceased.required' => 'Status kematian tidak boleh kosong',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->messages()->first(),
                ],422);
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
            $patient->city_code = $validated['city_code'];
            $patient->province = $validated['province'];
            $patient->province_code = $validated['province_code'];
            $patient->district = $validated['district'];
            $patient->district_code = $validated['district_code'];
            $patient->village = $validated['village'];
            $patient->village_code = $validated['village_code'];
            $patient->rt = $validated['rt'];
            $patient->rw = $validated['rw'];
            $patient->postal_code = $validated['postal_code'];
            $patient->marital_status = $validated['marital_status'];
            $patient->is_deceased = $validated['is_deceased'];
            $patient->relationship_name = $validated['relationship_name'];
            $patient->relationship_phone = $validated['relationship_phone'];
            $patient->save();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil mengupdate data pasien',
                    'data' => new PatientResource($patient),
                ],
                200,
            );
        } catch (ModelNotFoundException $error) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data pasien tidak ditemukan',
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
            $patient = Patient::findOrFail($id);

            $patient->delete();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Berhasil menghapus data pasien',
                ],
                200,
            );
        } catch (ModelNotFoundException $error) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Data pasien tidak ditemukan',
                ],
                404,
            );
        }
    }
}
