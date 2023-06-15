<?php

namespace App\Http\Controllers;

use App\Implementasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImplementasiController extends Controller
{
    public function index()
    {
        $implementasi = Implementasi::orderBy('id', 'DESC')->get();
        // $implementasiMobile = Implementasi::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.monthly.implementasi.history', [
            "title" => "Implementasi",
            "sub" => "Riwayat",
        ], compact('implementasi'));
    }

    public function create()
    {
        $user = User::all();
        return view('logadmin.monthly.implementasi.new', [
            "title" => "Implementasi",
            "sub" => "Tambah Data Baru",
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'program' => 'required',
            'start_date' => 'required',
            'end_date' => 'sometimes',
            'pelaksana' => 'required',
            'jumlah' => 'required',
            'penerima_manfaat' => 'required',
            'rab' => 'required',
            'realisasi' => 'required',
            'keterangan' => 'required',
        ]);

        $implementasi = new Implementasi($validated_data);
        $implementasi->user()->associate(Auth::user());
        $implementasi->save();

        return redirect('implementasi/history')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $implementasi = Implementasi::find($id);

        return view('logadmin.monthly.implementasi.edit', [
            "title" => "Implementasi",
            "sub" => "Ubah Data",
        ], compact('implementasi'));
    }

    public function update(Request $request, $id)
    {
        $implementasi = Implementasi::find($id);
        $validated_data = $request->validate([
            'program' => 'sometimes',
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
            'pelaksana' => 'sometimes',
            'jumlah' => 'sometimes',
            'penerima_manfaat' => 'sometimes',
            'rab' => 'sometimes',
            'realisasi' => 'sometimes',
            'keterangan' => 'sometimes',
        ]);

        $implementasi->update($validated_data);
        return  redirect('implementasi/history')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Implementasi $implementasi)
    {
        $implementasi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
