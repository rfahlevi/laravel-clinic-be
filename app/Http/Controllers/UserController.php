<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->input('name_search'), function ($query, $name_search) {
            return $query->where('name', 'like', '%' . $name_search . '%');
        })->paginate(10);

        return view('pages.user.index', [
            'type_menu' => 'user',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create', [
            'type_menu' => 'user',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:5",
            "phone" => "nullable|numeric",
            "role" => "required",
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with([
            "type_menu" => "user",
            "success" => "Berhasil menambahkan user baru"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit', [
            "type_menu" => "user",
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email,".$id,
//            "password" => "required|min:5",
            "phone" => "nullable|numeric",
            "role" => "required",
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
//        if($request->password) {
//            $user->password = bcrypt($request->password);
//        }
        $user->save();

        return redirect()->route('user.index')->with('success', "Berhasil mengupdate $user->name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', "Berhasil menghapus user $user->name");
    }
}
