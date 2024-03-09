<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->paginate(10);

        return view('pages.doctor.index', [
            "type_menu" => "doctor",
            "doctors" =>$doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.doctor.create', [
            "type_menu" => "doctor"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "sip" => "required|numeric",
            "specialization" => "required",
            "phone" => "numeric",
            "photo" => "image|mimes:jpeg,jpg,png,svg|max:2048",
            "email" => "required|email",
            "address" => "required"
        ]);

//        dd($request->all());

        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());
        }

        $doctor = new Doctor();
        $doctor->photo = $request->photo == null ? null : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->save();

        return redirect()->route('doctors.index')->with([
            "type_menu" => "doctor",
            "success" => "Berhasil menambahkan dokter baru : $doctor->name"
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
            "type_menu" => "doctor",
            "doctor" => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|unique:doctors,name,".$id,
            "sip" => "required|numeric",
            "specialization" => "required",
            "phone" => "numeric",
            "photo" => "image|mimes:jpeg,jpg,png,svg|max:2048",
            "email" => "required|email",
            "address" => "required"
        ]);

        if($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/doctors', $image->hashName());

            Storage::delete('public/doctors/'. basename($request->photo));
        }

        $doctor = Doctor::findOrFail($id);
        $doctor->photo = $request->photo == null ? $doctor->photo : $request->photo->hashName();
        $doctor->name = $request->name;
        $doctor->sip = $request->sip;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->save();

        return redirect()->route('doctors.index')->with([
            "type_menu" => "doctor",
            "success" => "Berhasil mengupdate dokter : $doctor->name"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', "Berhasil mengahapus $doctor->name dari database");
    }
}
