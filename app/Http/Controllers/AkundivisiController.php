<?php

namespace App\Http\Controllers;

use App\Akundivisi;
use App\Divisi;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AkundivisiController extends Controller
{
    public function index()
    {
        $akundivisi = Akundivisi::orderBy('id_level', 'ASC')->get();
        return view('logadmin.data.akundivisi.list', [
            "title" => "Data Akun Divisi",
            "sub" => "Daftar",
        ], compact('akundivisi'));
    }

    public function create($id)
    {
        // $akundivisi = Akundivisi::all();
        $level = Level::all();
        $divisi = Divisi::find($id);
        return view('logadmin.data.akundivisi.new', [
            "title" => "Data Akun Divisi",
            "sub" => "Tambah Akun Divisi",
        ], compact('divisi', 'level'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'username' => ['required', 'min:4', 'max:30', 'unique:tb_akundivisi'],
            'password' => 'required',
            'id_level' => 'required',
            'id_divisi' => 'required',
        ]);

        $validated_data['password'] = Hash::make($validated_data['password']);
        //Validasi pertama untuk menyimpan rencana kerja kedalam tabel rencana kerja
        $akundivisi = new Akundivisi($validated_data);
        // $akundivisi->user()->associate(Auth::user());
        $akundivisi->save();

        //Validasi kedua untuk mengisi foreignkey id_rencanakerja pada tabel surat masuk
        //isinya sesuai dengan id dari rencana kerja yang telah dibuat sebelumnya
        $divisi = Divisi::find($validated_data['id_divisi']);
        $divisi->akundivisi()->associate($akundivisi);
        $divisi->save();

        return redirect('divisi/list')->with('success', 'Data berhasil disimpan!');
    }


    public function edit($id)
    {
        $akundivisi = Akundivisi::find($id);
        $divisi = Divisi::where('akundivisi_id', $akundivisi->id)->get();
        $level = Level::all();
        return view('logadmin.data.akundivisi.edit', [
            "title" => "Akun Divisi",
            "sub" => "Ubah Data",
        ], compact('akundivisi', 'divisi', 'level'));
    }

    public function update(Request $request, $id)
    {
        $akundivisi = Akundivisi::find($id);

        $validatedData = Validator::make($request->all(), [
            'username' => [
                'sometimes',
                'min:4',
                'max:50',
                Rule::unique('tb_akundivisi')->ignore($id, 'id')
            ],
            'password' => 'sometimes',
        ])->validate();

        if (is_null($request->input('password'))) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        $akundivisi->update($validatedData);

        return redirect('divisi/list')->with('success', 'Data berhasil diubah!');
    }

    // public function detail($id)
    // {
    //     $user = User::find($id);
    //     $divisi = Divisi::all();
    //     $level = Level::all();
    //     return view('logadmin.data.user.detail', [
    //         "title" => "Data Pengguna",
    //         "sub" => "Detail Pengguna",
    //     ], compact('user', 'divisi', 'level'));
    // }

    public function destroy(Akundivisi $akundivisi)
    {
        $akundivisi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
