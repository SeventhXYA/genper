<?php

namespace App\Http\Controllers;

use App\Dailybp;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use Intervention\Image\Facades\Image;

class DailybpController extends Controller
{
    public function index()
    {
        $dailybp = Dailybp::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dailybpMobile = Dailybp::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        return view('daily.bisnisprofit.history', [
            "title" => "Bisnis & Profit",
        ], compact('dailybp', 'dailybpMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('daily.bisnisprofit.new', [
            "title" => "Daily Report Bisnis & Profit"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_bp' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        // $image_data = $request->file('foto');
        // $filename = 'uploads/dailybp/' . Auth::user()->username . time() . '.jpg';

        // $image = Image::make($image_data);

        // $image->fit(800, 600);
        // $image->encode('jpg', 90);
        // $image->stream();
        // Storage::disk('local')->put('public/' . $filename, $image, 'public');

        // $validated_data['pict'] = 'storage/' . $filename;
        $dailybp = new Dailybp($validated_data);
        $dailybp->user()->associate(Auth::user());
        $dailybp->save();

        return redirect('historybp')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dailybp = Dailybp::find($id);

        return view('daily.bisnisprofit.edit', [
            "title" => "Edit Daily Bisnis & Profit"
        ], compact('dailybp'));
    }

    public function update(Request $request, $id)
    {
        $dailybp = Dailybp::find($id);
        $validated_data = $request->validate([
            'tgl_bp' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        // if (array_key_exists('pict', $validated_data)) {
        //     $image_data = $request->file('pict');
        //     $filename = 'uploads/dailybp/' . Auth::user()->username . time() . '.jpg';

        //     $image = Image::make($image_data);

        //     $image->fit(800, 600);
        //     $image->encode('jpg', 90);
        //     $image->stream();
        //     Storage::disk('local')->put('public/' . $filename, $image, 'public');
        //     Storage::disk('local')->delete($dailybp->pict);

        //     $validated_data['pict'] = 'storage/' . $filename;
        // }

        $dailybp->update($validated_data);
        return  redirect('historybp')->with('success', 'Data berhasil diubah!');
    }
}
