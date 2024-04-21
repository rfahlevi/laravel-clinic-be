<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicService;
use Illuminate\Support\Facades\Validator;

class ClinicServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = ClinicService::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('name')
            ->get();

        return view('pages.clinic_services.index', [
            'type_menu' => 'clinic_service',
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.clinic_services.create', [
            'type_menu' => 'clinic_service',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:clinic_services,name,',
            'category' => 'required',
            'price' => 'required|numeric|min:100',
            'qty' => 'nullable',
        ];

        $messages = [
            'name.required' => 'Nama Layanan harus diisi',
            'name.unique' => 'Layanan klinik sudah terdaftar',
            'category.required' => 'Kategori Layanan harus diisi',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga minimal Rp.100',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $newService = $validator->validated();

        ClinicService::create([
            'name' => $newService['name'],
            'category' => $newService['category'],
            'price' => $newService['price'],
            'qty' => $newService['qty'],
        ]);

        return redirect(route('clinic-services.index'))->with('success', 'Berhasil menambahkan layanan klinik');
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
        $service = ClinicService::findOrFail($id);

        return view('pages.clinic_services.edit', [
            'type_menu' => 'clinic_service',
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = ClinicService::findOrFail($id);

        $rules = [
            'name' => 'required|unique:clinic_services,name,' . $service->id,
            'category' => 'required',
            'price' => 'required|numeric|min:100',
            'qty' => 'nullable',
        ];

        $messages = [
            'name.required' => 'Nama Layanan harus diisi',
            'name.unique' => 'Layanan klinik sudah terdaftar',
            'category.required' => 'Kategori Layanan harus diisi',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga minimal Rp.100',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $data = $validator->validated();

        $service->name = $data['name'];
        $service->category = $data['category'];
        $service->price = $data['price'];
        $service->qty = $data['qty'];
        $service->save();

        return redirect()->route('clinic-services.index')->with('success', 'Berhasil mengubah layanan klinik');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = ClinicService::findOrFail($id);

        $service->delete();

        return redirect()->route('clinic-services.index')->with('success', 'Berhasil menghapus layanan klinik');
    }
}
