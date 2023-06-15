<?php

namespace App\Http\Controllers;

use App\Kgkoperasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KgkoperasiController extends Controller
{
    public function index()
    {
        $kgkoperasi = Kgkoperasi::orderBy('id', 'DESC')->get();
        // $kgkoperasiMobile = kgkoperasi::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.monthly.kgkoperasi.history', [
            "title" => "Kegiatan Koperasi",
            "sub" => "Riwayat",
        ], compact('kgkoperasi'));
    }

    public function create()
    {
        $user = User::all();
        return view('logadmin.monthly.kgkoperasi.new', [
            "title" => "Kegiatan Koperasi",
            "sub" => "Tambah Data Baru",
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'kegiatan' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'pelaksana' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        $kgkoperasi = new Kgkoperasi($validated_data);
        $kgkoperasi->user()->associate(Auth::user());
        $kgkoperasi->save();

        return redirect('kgkoperasi/history')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $kgkoperasi = Kgkoperasi::find($id);

        return view('logadmin.monthly.kgkoperasi.edit', [
            "title" => "Kegiatan Koperasi",
            "sub" => "Ubah Data",
        ], compact('kgkoperasi'));
    }

    public function update(Request $request, $id)
    {
        $kgkoperasi = Kgkoperasi::find($id);
        $validated_data = $request->validate([
            'kegiatan' => 'sometimes',
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
            'pelaksana' => 'sometimes',
            'jumlah' => 'sometimes',
            'keterangan' => 'sometimes',
        ]);

        $kgkoperasi->update($validated_data);
        return  redirect('kgkoperasi/history')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Kgkoperasi $kgkoperasi)
    {
        $kgkoperasi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
