<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Level;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profil.detail', [
            "title" => "Profil",
            "sub" => "Profil Pengguna",
        ], compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $divisi = Divisi::all();
        $level = Level::all();
        return view('profil.edit', [
            "title" => "Profil",
            "sub" => "Ubah Profil",
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

        return redirect('profile')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(User $user)
    {
        //
    }
}
