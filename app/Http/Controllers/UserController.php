<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Level;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id_level', 'ASC')->get();
        return view('logadmin.data.user.list', [
            "title" => "Data Pengguna",
            "sub" => "Daftar",
        ], compact('user'));
    }

    public function create()
    {
        $user = User::all();
        $divisi = Divisi::all();
        $level = Level::all();
        return view('logadmin.data.user.new', [
            "title" => "Data Pengguna",
            "sub" => "Tambah Pengguna",
        ], compact('user', 'divisi', 'level'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'nm_depan' => 'required',
            'nm_belakang' => 'sometimes',
            'jk' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'nohp' => 'required',
            'email' => 'required|email:dns|unique:tb_user',
            'id_divisi' => 'sometimes',
            'username' => ['required', 'max:30', 'unique:tb_user'],
            'password' => 'required',
            'id_level' => 'required',
        ]);

        // $username = $validated_data('username');
        // $existingUser = User::where('username', $username)->first();
        // if ($existingUser) {
        //     return redirect()->back()->withErrors(['username' => 'Username sudah terdaftar']);
        // }

        $validated_data['password'] = Hash::make($validated_data['password']);
        $user = new User($validated_data);
        $user->save();

        return redirect('user/list')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $divisi = Divisi::all();
        $level = Level::all();
        return view('logadmin.data.user.edit', [
            "title" => "Data Pengguna",
            "sub" => "Ubah Data",
        ], compact('user', 'divisi', 'level'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validated_data = $request->validate([
            'nm_depan' => 'sometimes',
            'nm_belakang' => 'sometimes',
            'jk' => 'sometimes',
            'tmp_lahir' => 'sometimes',
            'tgl_lahir' => 'sometimes',
            'nohp' => 'sometimes',
            'email' => [
                'sometimes',
                'email:dns',
                Rule::unique('tb_user')->ignore($user->id),
            ],
            'id_divisi' => 'sometimes',
            'username' => [
                'sometimes',
                'min:4',
                'max:30',
                Rule::unique('tb_user')->ignore($user->id),
            ],
            'password' => 'sometimes',
            'id_level' => 'sometimes',
        ]);

        if (isset($validated_data['password'])) {
            $validated_data['password'] = Hash::make($validated_data['password']);
        }

        $user->update($validated_data);

        return redirect('user/list')->with('success', 'Data berhasil diubah!');
    }

    public function detail($id)
    {
        $user = User::find($id);
        $divisi = Divisi::all();
        $level = Level::all();
        return view('logadmin.data.user.detail', [
            "title" => "Data Pengguna",
            "sub" => "Detail Pengguna",
        ], compact('user', 'divisi', 'level'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
