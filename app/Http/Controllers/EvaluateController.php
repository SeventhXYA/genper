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
        return view('daily.evaluasi.history', [
            "title" => "Evaluasi Harian",
            "sesi" => "Evaluasi Harian"
        ], compact('evaluate', 'evaluateMobile'));
    }

    public function create()
    {
        $user = User::all();
        return view('daily.evaluasi.new', [
            "title" => "Daily Report Evaluasi Harian"
        ], compact('user'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'tgl_ev' => 'required',
            'dailyevaluate' => 'required'
        ]);

        // $image_data = $request->file('foto');
        // $filename = 'uploads/evaluate/' . Auth::user()->username . time() . '.jpg';

        // $image = Image::make($image_data);

        // $image->fit(800, 600);
        // $image->encode('jpg', 90);
        // $image->stream();
        // Storage::disk('local')->put('public/' . $filename, $image, 'public');

        // $validated_data['pict'] = 'storage/' . $filename;
        $evaluate = new Evaluate($validated_data);
        $evaluate->user()->associate(Auth::user());
        $evaluate->save();

        return redirect('historyev')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $evaluate = Evaluate::find($id);

        return view('daily.evaluasi.edit', [
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

        // if (array_key_exists('pict', $validated_data)) {
        //     $image_data = $request->file('pict');
        //     $filename = 'uploads/evaluate/' . Auth::user()->username . time() . '.jpg';

        //     $image = Image::make($image_data);

        //     $image->fit(800, 600);
        //     $image->encode('jpg', 90);
        //     $image->stream();
        //     Storage::disk('local')->put('public/' . $filename, $image, 'public');
        //     Storage::disk('local')->delete($evaluate->pict);

        //     $validated_data['pict'] = 'storage/' . $filename;
        // }

        $evaluate->update($validated_data);
        return  redirect('historyev')->with('success', 'Data berhasil diubah!');
    }
}
