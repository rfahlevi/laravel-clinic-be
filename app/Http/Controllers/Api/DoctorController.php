<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mendapatkan data dokter',
                'data' => DoctorResource::collection($doctors),
                'current_page' => $doctors->currentPage(),
                'last_page' => $doctors->lastPage(),
                'total' => $doctors->total(),
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
            'name' => 'required',
            'sip' => 'required|numeric:unique:doctors,sip,',
            'id_ihs' => 'required|numeric|unique:doctors,id_ihs,',
            'nik' => 'required|numeric|unique:doctors,nik,',
            'specialization' => 'required',
            'phone' => 'numeric',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'email' => 'required|email',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama dokter tidak boleh kosong',
            'sip.required' => 'SIP dokter tidak boleh kosong',
            'sip.numeric' => 'SIP dokter harus berupa angka',
            'sip.unique' => 'SIP dokter sudah terdaftar',
            'id_ihs.required' => 'ID IHS dokter tidak boleh kosong',
            'id_ihs.numeric' => 'ID IHS dokter harus berupa angka',
            'id_ihs.unique' => 'ID IHS dokter sudah terdaftar',
            'nik.required' => 'NIK dokter tidak boleh kosong',
            'nik.numeric' => 'NIK dokter harus berupa angka',
            'nik.unique' => 'NIK dokter sudah terdaftar',
            'specialization.required' => 'Spesialisasi dokter tidak boleh kosong',
            'phone.numeric' => 'Nomor telepon dokter harus berupa angka',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'File harus berupa jpeg, jpg, png, svg',
            'photo.max' => 'File tidak boleh lebih dari 2MB',
            'email.required' => 'Email dokter tidak boleh kosong',
            'email.email' => 'Email dokter harus berupa email',
            'address.required' => 'Alamat dokter tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->messages()->first(),
                ],
                400,
            );
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());
        }

        $doctor = new Doctor();
        $doctor->photo = $request->photo == null ? null : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = trim($request->address);
        $doctor->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil menambahkan dokter baru : ' . $doctor->name,
                'data' => new DoctorResource($doctor),
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
            $doctor = Doctor::findOrFail($id);

        $rules = [
            'name' => 'required',
            'sip' => 'required|numeric:unique:doctors,sip,' . $id,
            'id_ihs' => 'required|numeric|unique:doctors,id_ihs,' . $id,
            'nik' => 'required|numeric|unique:doctors,nik,' . $id,
            'specialization' => 'required',
            'phone' => 'numeric',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'email' => 'required|email',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama dokter tidak boleh kosong',
            'sip.required' => 'SIP dokter tidak boleh kosong',
            'sip.numeric' => 'SIP dokter harus berupa angka',
            'sip.unique' => 'SIP dokter sudah terdaftar',
            'id_ihs.required' => 'ID IHS dokter tidak boleh kosong',
            'id_ihs.numeric' => 'ID IHS dokter harus berupa angka',
            'id_ihs.unique' => 'ID IHS dokter sudah terdaftar',
            'nik.required' => 'NIK dokter tidak boleh kosong',
            'nik.numeric' => 'NIK dokter harus berupa angka',
            'nik.unique' => 'NIK dokter sudah terdaftar',
            'specialization.required' => 'Spesialisasi dokter tidak boleh kosong',
            'phone.numeric' => 'Nomor telepon dokter harus berupa angka',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'File harus berupa jpeg, jpg, png, svg',
            'photo.max' => 'File tidak boleh lebih dari 2MB',
            'email.required' => 'Email dokter tidak boleh kosong',
            'email.email' => 'Email dokter harus berupa email',
            'address.required' => 'Alamat dokter tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->messages()->first(),
                ],
                400,
            );
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());

            Storage::delete('public/doctors/' . basename($doctor->photo));
        }

        $doctor->photo = $request->photo == null ? $doctor->photo : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil mengupdate dokter : ' . $doctor->name,
                'data' => new DoctorResource($doctor),
            ],
            200,
        );
        } catch (ModuleNotFoundException $error) {
            return response()->json([
                'status' => false,
                'message' => 'Dokter tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       try {
         $doctor = Doctor::findOrFail($id);

        Storage::delete('public/doctors/' . basename($doctor->photo));

        $doctor->delete();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil menghapus dokter : ' . $doctor->name,
            ],
            200,
        );
       } catch (ModelNotFoundException $error) {
            return response()->json([
                'status' => false,
                'message' => 'Dokter tidak ditemukan',
            ], 404);
       }
    }
}
