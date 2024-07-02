<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('sip', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.doctor.index', [
            'type_menu' => 'doctor',
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.doctor.create', [
            'type_menu' => 'doctor',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'sip' => 'required|numeric|unique:doctors,sip,',
            'id_ihs' => 'required|numeric|unique:doctors,id_ihs,',
            'nik' => 'required|numeric|unique:doctors,nik,',
            'specialization' => 'required',
            'phone' => 'numeric',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'email' => 'required|email',
            'address' => 'nullable',
        ];

        $messages = [
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'File harus berukuran maksimal 2 MB',
            'photo.mimes' => 'File harus berupa jpeg, jpg, png, svg',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'phone.required' => 'Nomor telepon harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email',
            'email.unique' => 'Email sudah terdaftar',
            'address.required' => 'Alamat harus diisi',
            'specialization.required' => 'Spesialisasi harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'id_ihs.required' => 'IHS harus diisi',
            'id_ihs.unique' => 'IHS sudah terdaftar',
            'sip.required' => 'SIP harus diisi',
            'sip.unique' => 'SIP sudah terdaftar',
            'name.required' => 'Nama harus diisi',
            'nik.numeric' => 'NIK harus berupa angka',
        ];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());
        }

        $validator = Validator::make($request->all(), $rules, $messages);


        // Store to user table
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('password');
        $user->phone = $request->phone;
        $user->role = 'dokter';
        $user->save();

        // Store to doctor table
        $doctor = new Doctor();
        $doctor->photo = $request->photo == null ? 'https://img.freepik.com/free-vector/hand-drawn-doctor-cartoon-illustration_23-2150696182.jpg?w=1380&t=st=1713247452~exp=1713248052~hmac=9577a7ec13c38b3970158e3ce731b4441ea4f2c5f2bc9ac3fc487377360e4f64' : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = trim($request->address);
        $doctor->save();

        return redirect()
            ->route('doctors.index')
            ->with([
                'type_menu' => 'doctor',
                'success' => "Berhasil menambahkan dokter baru : $doctor->name",
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('pages.doctor.edit', [
            'type_menu' => 'doctor',
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'sip' => 'required|numeric:unique:doctors,sip,' . $id,
            'id_ihs' => 'required|numeric|unique:doctors,id_ihs,' . $id,
            'nik' => 'required|numeric|unique:doctors,nik,' . $id,
            'specialization' => 'required',
            'phone' => 'numeric',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());

            Storage::delete('public/doctors/' . basename($doctor->photo));
        }

        $doctor->photo = $request->photo == null ? 'https://img.freepik.com/free-vector/hand-drawn-doctor-cartoon-illustration_23-2150696182.jpg?w=1380&t=st=1713247452~exp=1713248052~hmac=9577a7ec13c38b3970158e3ce731b4441ea4f2c5f2bc9ac3fc487377360e4f64' : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->save();

        return redirect()
            ->route('doctors.index')
            ->with([
                'type_menu' => 'doctor',
                'success' => "Berhasil mengupdate dokter : $doctor->name",
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()
            ->route('doctors.index')
            ->with('success', "Berhasil mengahapus $doctor->name dari database");
    }
}
