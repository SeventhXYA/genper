<?php

namespace App\Http\Controllers;

use App\Dailyic;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DailyicController extends Controller
{
    public function index()
    {
        $dailyic = Dailyic::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dailyicMobile = Dailyic::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        return view('loggenper.inovasicreativity.history', [
            "title" => "Self-Development",
        ], compact('dailyic', 'dailyicMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('loggenper.inovasicreativity.new', [
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
        $filename = 'uploads/dailyic/' . Auth::user()->username . time() . '.jpg';

        $image = Image::make($request->file('foto')->getRealPath());
        // $image = Image::make($image_data);

        $image->fit(800, 600);
        $image->encode('jpg', 90);
        $image->stream();
        Storage::disk('local')->put('public/' . $filename, $image, 'public');

        $validated_data['foto'] = 'storage/' . $filename;
        $dailyic = new Dailyic($validated_data);
        $dailyic->user()->associate(Auth::user());
        $dailyic->save();

        return redirect('inovasicreativity/historyic')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dailyic = Dailyic::find($id);

        return view('loggenper.inovasicreativity.edit', [
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

        if (array_key_exists('foto', $validated_data)) {
            $image_data = $request->file('foto');
            $filename = 'uploads/dailyic/' . Auth::user()->username . time() . '.jpg';

            $image = Image::make($image_data);

            $image->fit(800, 600);
            $image->encode('jpg', 90);
            $image->stream();
            Storage::disk('local')->put('public/' . $filename, $image, 'public');
            Storage::disk('local')->delete($dailyic->foto);

            $validated_data['foto'] = 'storage/' . $filename;
        }

        $dailyic->update($validated_data);
        return  redirect('inovasicreativity/historyic')->with('success', 'Data berhasil diubah!');
    }

    public function reportAdmin()
    {
        $dailyic = Dailyic::orderBy('id', 'DESC')->get();
        $dailyicMobile = Dailyic::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.daily.inovasicreativity', [
            "title" => "Inovasi & Creativity",
        ], compact('dailyic', 'dailyicMobile'));
    }

    public function destroy(Dailyic $dailyic)
    {
        $dailyic->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
