<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Level;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::orderBy('id', 'ASC')->get();
        return view('logadmin.data.divisi.list', [
            "title" => "Data Divisi",
            "sub" => "Daftar",
        ], compact('divisi'));
    }

    public function create()
    {
        $divisi = divisi::all();
        $divisi = Divisi::all();
        $level = Level::all();
        return view('logadmin.data.divisi.new', [
            "title" => "Data  Divisi",
            "sub" => "Tambah  Divisi",
        ], compact('divisi', 'divisi', 'level'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'divisi' => 'required',
            'id_akundivisi' => 'sometimes'
        ]);
        $divisi = new Divisi($validated_data);
        $divisi->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::find($id);
        $validated_data = $request->validate([
            'divisi' => 'required',
            'id_akundivisi' => 'sometimes'
        ]);

        $divisi->update($validated_data);
        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
