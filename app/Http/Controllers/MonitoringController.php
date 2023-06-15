<?php

namespace App\Http\Controllers;

use App\Monitoring;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index()
    {
        $monitoring = Monitoring::orderBy('id', 'DESC')->get();
        // $monitoringMobile = monitoring::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.monthly.monitoring.history', [
            "title" => "Monitoring & Evaluasi",
            "sub" => "Riwayat",
        ], compact('monitoring'));
    }

    public function create()
    {
        $user = User::all();
        return view('logadmin.monthly.monitoring.new', [
            "title" => "Monitoring & Evaluasi",
            "sub" => "Tambah Data Baru",
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'program' => 'required',
            'keterangan' => 'required',
            'output' => 'required',
            'outcome' => 'required',
        ]);

        $monitoring = new Monitoring($validated_data);
        $monitoring->user()->associate(Auth::user());
        $monitoring->save();

        return redirect('monitoring/history')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $monitoring = Monitoring::find($id);

        return view('logadmin.monthly.monitoring.edit', [
            "title" => "Monitoring & Evaluasi",
            "sub" => "Ubah Data",
        ], compact('monitoring'));
    }

    public function update(Request $request, $id)
    {
        $monitoring = Monitoring::find($id);
        $validated_data = $request->validate([
            'program' => 'sometimes',
            'keterangan' => 'sometimes',
            'output' => 'sometimes',
            'outcome' => 'sometimes',
        ]);

        $monitoring->update($validated_data);
        return  redirect('monitoring/history')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Monitoring $monitoring)
    {
        $monitoring->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
