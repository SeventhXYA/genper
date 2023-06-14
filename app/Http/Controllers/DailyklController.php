<?php

namespace App\Http\Controllers;

use App\Dailykl;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DailyklController extends Controller
{
    public function index()
    {
        $dailykl = Dailykl::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dailyklMobile = Dailykl::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        return view('loggenper.kelembagaan.history', [
            "title" => "Kelembagaan",
            "sesi" => "Kelembagaan"
        ], compact('dailykl', 'dailyklMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('loggenper.kelembagaan.new', [
            "title" => "Daily Report Kelembagaan"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_kl' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        $filename = 'uploads/dailykl/' . Auth::user()->username . time() . '.jpg';

        $image = Image::make($request->file('foto')->getRealPath());

        $image->fit(800, 600);
        $image->encode('jpg', 90);
        $image->stream();
        Storage::disk('local')->put('public/' . $filename, $image, 'public');

        $validated_data['foto'] = 'storage/' . $filename;
        $dailykl = new Dailykl($validated_data);
        $dailykl->user()->associate(Auth::user());
        $dailykl->save();

        return redirect('historykl')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dailykl = Dailykl::find($id);

        return view('loggenper.kelembagaan.edit', [
            "title" => "Edit Daily Kelembagaan"
        ], compact('dailykl'));
    }

    public function update(Request $request, $id)
    {
        $dailykl = Dailykl::find($id);
        $validated_data = $request->validate([
            'tgl_kl' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        if (array_key_exists('foto', $validated_data)) {
            $image_data = $request->file('foto');
            $filename = 'uploads/dailykl/' . Auth::user()->username . time() . '.jpg';

            $image = Image::make($image_data);

            $image->fit(800, 600);
            $image->encode('jpg', 90);
            $image->stream();
            Storage::disk('local')->put('public/' . $filename, $image, 'public');
            Storage::disk('local')->delete($dailykl->foto);

            $validated_data['foto'] = 'storage/' . $filename;
        }

        $dailykl->update($validated_data);
        return  redirect('historykl')->with('success', 'Data berhasil diubah!');
    }

    public function reportAdmin()
    {
        $dailykl = Dailykl::orderBy('id', 'DESC')->get();
        $dailyklMobile = Dailykl::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.daily.kelembagaan', [
            "title" => "Kelembagaan",
        ], compact('dailykl', 'dailyklMobile'));
    }

    public function destroy(Dailykl $dailykl)
    {
        $dailykl->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
