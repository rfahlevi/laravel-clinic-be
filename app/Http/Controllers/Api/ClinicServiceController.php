<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ClinicService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClinicServiceResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            ->paginate(10);
        
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mendapatkan data layanan klinik',
                'data' => ClinicServiceResource::collection($services),
                'current_page' => $services->currentPage(),
                'last_page' => $services->lastPage(),
                'total' => $services->total(),
            ], 200);
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

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ], 422);
        }

        $service = new ClinicService();
        $service->name = $request->name;
        $service->category = $request->category;
        $service->price = $request->price;
        $service->qty = $request->qty;
        $service->save();

        return response()->json([
            'status' => true,
            'message' => 'Layanan klinik ditambahkan',
            'data' => new ClinicServiceResource($service),
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
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

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first(),
            ], 422);
        }

        $service->name = $request->name;
        $service->category = $request->category;
        $service->price = $request->price;
        $service->qty = $request->qty;
        $service->save();

        return response()->json([
            'status' => true,
            'message' => 'Layanan klinik diperbarui',
            'data' => new ClinicServiceResource($service),
        ]);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => 'Layanan klinik tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $service = ClinicService::findOrFail($id);

            $service->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengahapus layanan klinik',
            ]);
        } catch (ModelNotFoundException $err) {
            return response()->json([
                'status' => false,
                'message' => 'Layanan klinik tidak ditemukan',
            ], 404);
        }
    }
}
