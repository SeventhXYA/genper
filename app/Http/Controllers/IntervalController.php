<?php

namespace App\Http\Controllers;

use App\Interval;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntervalController extends Controller
{


    public function store(Request $request)
    {
        $validated_data = $request->validate([

            'interval_bp' => 'sometimes',

            'interval_sd' => 'sometimes',

            'interval_ic' => 'sometimes',

            'interval_kl' => 'sometimes',

        ]);

        $interval = new Interval($validated_data);
        $interval->user()->associate(Auth::user());
        $interval->save();

        return redirect()->route('/')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function destroy(Interval $interval)
    {
        $interval->delete();
        return redirect()->back()->with([
            'success' => 'Data berhasil dihapus!'
        ]);
    }

    // public function edit()
    // {
    //     $interval = Auth::user()->interval()->first();

    //     return view('pomodoro.editpomodororeport', [
    //         "title" => "Edit Daily Self-Development"
    //     ], compact('interval'));
    // }

    public function update(Request $request)
    {
        // $interval = Auth::user()->interval()->first();

        $validated_data = $request->validate([
            'interval_bp' => 'sometimes',

            'interval_sd' => 'sometimes',

            'interval_ic' => 'sometimes',

            'interval_kl' => 'sometimes',
        ]);

        $old_interval = Auth::user()->interval()->first();
        $validated_data['id'] = $old_interval->id;
        $old_interval->delete();

        $interval = new Interval($validated_data);
        $interval->user()->associate(Auth::user());
        $interval->save();

        return redirect()->route('/');
    }

    public function reportAdmin()
    {
        $interval = Interval::orderBy('id', 'DESC')->get();
        // $users = User::where('level_id', 3)->get();
        $intervalMobile = Interval::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.daily.interval', [
            "title" => "Interval Pomodoro"
        ], compact('interval', 'intervalMobile'));
    }
}
