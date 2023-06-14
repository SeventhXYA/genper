<?php

namespace App\Http\Controllers;

use App\Weekly;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyController extends Controller
{
    public function index()
    {
        $akundivisi = Auth::guard('divisi')->user();
        $weekly = Weekly::where('id_akundivisi', $akundivisi->id)->orderBy('id', 'DESC')->get();
        return view('logdivisi.weekly.history', [
            "title" => "Self-Development",
            "sesi" => "SELF-DEVELOPMENT"
        ], compact('weekly'));
    }

    public function create()
    {
        // $user = User::all();
        $weekly = Weekly::all();
        return view('logdivisi.weekly.new', [
            "title" => "Tambah Weekly Plan"
        ], compact('user', 'weekly'));
    }

    public function events()
    {
        $weekly = Weekly::select('id', 'rencana as title', 'start_date as start', 'end_date as end')->get()->toArray();
        return response()->json($weekly);
    }

    public function show($id)
    {
        $kalenderweekly = weekly::findOrFail($id);
        return response()->json($kalenderweekly);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'rencana' => 'required',
        ]);

        $weekly = new Weekly($validated_data);
        $akundivisi = Auth::guard('divisi')->user();
        $weekly->akundivisi()->associate($akundivisi);
        $weekly->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $weekly = Weekly::find($id);
        $validated_data = $request->validate([
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
            'rencana' => 'sometimes',
            'status' => 'sometimes',
            'progres' => 'sometimes',
        ]);

        $weekly->update($validated_data);
        return  redirect()->back()->with('success', 'Data berhasil diubah!');
    }

    public function indexAdmin()
    {
        $weekly = Weekly::orderBy('id', 'DESC')->orderBy('id_akundivisi', 'ASC')->get();
        return view('logadmin.weekly.list', [
            "title" => "Self-Development",
            "sesi" => "SELF-DEVELOPMENT"
        ], compact('weekly'));
    }

    public function destroy(Weekly $weekly)
    {
        $weekly->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
