<?php

namespace App\Http\Controllers;

use App\Evaluate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EvaluateController extends Controller
{
    public function index()
    {
        $evaluate = Evaluate::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $evaluateMobile = Evaluate::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        // $evaluate = evaluate::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->get();
        return view('loggenper.evaluasi.history', [
            "title" => "Evaluasi Harian",
            "sesi" => "Evaluasi Harian"
        ], compact('evaluate', 'evaluateMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('loggenper.evaluasi.new', [
            "title" => "Daily Report Evaluasi Harian"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_ev' => 'required',
            'dailyevaluate' => 'required'
        ]);
        $evaluate = new Evaluate($validated_data);
        $evaluate->user()->associate(Auth::user());
        $evaluate->save();

        return redirect('historyev')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $evaluate = Evaluate::find($id);

        return view('loggenper.evaluasi.edit', [
            "title" => "Edit Daily Evaluasi Harian"
        ], compact('evaluate'));
    }

    public function update(Request $request, $id)
    {
        $evaluate = Evaluate::find($id);
        $validated_data = $request->validate([
            'tgl_ev' => 'required',
            'dailyevaluate' => 'required'
        ]);
        $evaluate->update($validated_data);
        return  redirect('historyev')->with('success', 'Data berhasil diubah!');
    }

    public function reportAdmin()
    {
        $dailyev = Evaluate::orderBy('id', 'DESC')->get();
        $dailyevMobile = Evaluate::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.daily.evaluasi', [
            "title" => "Evaluasi Harian",
        ], compact('dailyev', 'dailyevMobile'));
    }
    public function destroy(Evaluate $evaluasi)
    {
        $evaluasi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
