<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Dailysd;
use App\Dailybp;
use App\Dailykl;
use App\Dailyic;
use App\Divisi;
use App\Evaluate;
use App\IntervalBp;
use App\IntervalIc;
use App\IntervalKl;
use App\IntervalOthers;
use App\IntervalSd;
use App\Longtermtarget;
use App\Interval;
use App\User;
use App\Weekly;
use App\Weeklybp;
use App\Weeklyic;
use App\Weeklykl;
use App\Weeklysd;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guard('divisi')->user()) {
            $akundivisi = Auth::guard('divisi')->user();
            $userDivisi = User::where('id_divisi', Auth::guard('divisi')->user()->divisi->id)->count();
            $weeklyPlan = Weekly::where('id_akundivisi', Auth::guard('divisi')->user()->id)->whereBetween('start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $weeklyPlanCount = Weekly::where('id_akundivisi', Auth::guard('divisi')->user()->id)->whereBetween('start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        }

        $dailysd = Dailysd::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailybp = Dailybp::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailykl = Dailykl::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailyic = Dailyic::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $evaluate = Evaluate::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();

        $divisi = Divisi::count();

        $user = Auth::user();

        $users = User::where('id_level', 3)->count();

        $pengguna = User::where('id_level', 3)->get();
        $dailysdReport = Dailysd::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailybpReport = Dailybp::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailyklReport = Dailykl::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailyicReport = Dailyic::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $evaluateReport = Evaluate::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $kalenderweekly = Weekly::all();


        return view('dashboard', [
            "title" => "Beranda"
        ], compact('user', 'users', 'dailysd', 'dailybp', 'dailykl', 'dailyic', 'evaluate', 'divisi', 'dailysdReport', 'dailybpReport', 'dailyklReport', 'dailyicReport', 'evaluateReport', 'pengguna', 'kalenderweekly', (Auth::guard('divisi')->user() ? ['akundivisi', 'userDivisi', 'weeklyPlan', 'weeklyPlanCount'] : [])));
    }

    public function events()
    {
        $akundivisi = Auth::guard('divisi')->user();
        $kalenderweekly = Weekly::where('id_akundivisi', $akundivisi->id)->select('id', 'rencana as title', 'start_date as start', 'end_date as end')->get()->toArray();
        return response()->json($kalenderweekly);
    }
    public function show($id)
    {
        $kalenderweekly = Weekly::findOrFail($id);
        return response()->json($kalenderweekly);
    }
}
