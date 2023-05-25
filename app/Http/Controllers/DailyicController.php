<?php

namespace App\Http\Controllers;

use App\Dailyic;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DailyicController extends Controller
{
    public function index()
    {
        $dailyic = Dailyic::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dailyicMobile = Dailyic::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        return view('daily.inovasicreativity.history', [
            "title" => "Self-Development",
        ], compact('dailyic', 'dailyicMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('daily.inovasicreativity.new', [
            "title" => "Daily Report Bisnis & Profit"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_ic' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        // $image_data = $request->file('foto');
        // $filename = 'uploads/dailyic/' . Auth::user()->username . time() . '.jpg';

        // $image = Image::make($image_data);

        // $image->fit(800, 600);
        // $image->encode('jpg', 90);
        // $image->stream();
        // Storage::disk('local')->put('public/' . $filename, $image, 'public');

        // $validated_data['pict'] = 'storage/' . $filename;
        $dailyic = new Dailyic($validated_data);
        $dailyic->user()->associate(Auth::user());
        $dailyic->save();

        return redirect('historyic')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dailyic = Dailyic::find($id);

        return view('daily.inovasicreativity.edit', [
            "title" => "Edit Daily Bisnis & Profit"
        ], compact('dailyic'));
    }

    public function update(Request $request, $id)
    {
        $dailyic = Dailyic::find($id);
        $validated_data = $request->validate([
            'tgl_ic' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        // if (array_key_exists('pict', $validated_data)) {
        //     $image_data = $request->file('pict');
        //     $filename = 'uploads/dailyic/' . Auth::user()->username . time() . '.jpg';

        //     $image = Image::make($image_data);

        //     $image->fit(800, 600);
        //     $image->encode('jpg', 90);
        //     $image->stream();
        //     Storage::disk('local')->put('public/' . $filename, $image, 'public');
        //     Storage::disk('local')->delete($dailyic->pict);

        //     $validated_data['pict'] = 'storage/' . $filename;
        // }

        $dailyic->update($validated_data);
        return  redirect('historyic')->with('success', 'Data berhasil diubah!');
    }
}
