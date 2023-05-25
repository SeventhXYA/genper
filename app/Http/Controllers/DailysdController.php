<?php

namespace App\Http\Controllers;

use App\Dailysd;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;

class DailysdController extends Controller
{
    public function index()
    {
        $dailysd = Dailysd::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $dailysdMobile = Dailysd::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->simplePaginate(6);
        // $dailysd = Dailysd::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->get();
        return view('daily.selfdevelopment.history', [
            "title" => "Self-Development",
            "sesi" => "SELF-DEVELOPMENT"
        ], compact('dailysd', 'dailysdMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('daily.selfdevelopment.new', [
            "title" => "Daily Report Self-Development"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_sd' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        $image_data = $request->file('foto');
        $filename = 'uploads/dailysd/' . Auth::user()->username . time() . '.jpg';

        $image = Image::make($image_data);

        $image->fit(800, 600);
        $image->encode('jpg', 90);
        $image->stream();
        Storage::disk('local')->put('public/' . $filename, $image, 'public');

        $validated_data['foto'] = 'storage/' . $filename;
        $dailysd = new Dailysd($validated_data);
        $dailysd->user()->associate(Auth::user());
        $dailysd->save();

        return redirect('historysd')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $dailysd = Dailysd::find($id);

        return view('daily.selfdevelopment.edit', [
            "title" => "Edit Daily Self-Development"
        ], compact('dailysd'));
    }

    public function update(Request $request, $id)
    {
        $dailysd = Dailysd::find($id);
        $validated_data = $request->validate([
            'tgl_sd' => 'required',
            'wkt_mulai' => 'required',
            'wkt_selesai' => 'required',
            'rencana' => 'required',
            'aktual' => 'required',
            'progres' => 'required|numeric',
            'foto' => 'image',
        ]);

        // if (array_key_exists('pict', $validated_data)) {
        //     $image_data = $request->file('pict');
        //     $filename = 'uploads/dailysd/' . Auth::user()->username . time() . '.jpg';

        //     $image = Image::make($image_data);

        //     $image->fit(800, 600);
        //     $image->encode('jpg', 90);
        //     $image->stream();
        //     Storage::disk('local')->put('public/' . $filename, $image, 'public');
        //     Storage::disk('local')->delete($dailysd->pict);

        //     $validated_data['pict'] = 'storage/' . $filename;
        // }

        $dailysd->update($validated_data);
        return  redirect('historysd')->with('success', 'Data berhasil diubah!');
    }
}
