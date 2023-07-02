<?php

namespace App\Http\Controllers;

use App\Akundivisi;
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
        $userId = null;
        $dailysdCounts = [];
        $dailybpCounts = [];
        $dailyklCounts = [];
        $dailyicCounts = [];
        $dailyevCounts = [];

        if (Auth::guard('divisi')->user()) {
            $akundivisi = Auth::guard('divisi')->user();
            $userDivisi = User::where('id_divisi', $akundivisi->divisi->id)->count();
            $weeklyPlan = Weekly::where('id_akundivisi', $akundivisi->id)
                ->whereBetween('start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get();
            $weeklyPlanCount = $weeklyPlan->count();
        }

        $dailysd = Dailysd::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailybp = Dailybp::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailykl = Dailykl::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $dailyic = Dailyic::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();
        $evaluate = Evaluate::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->count();

        $divisi = Divisi::count();

        $user = Auth::user();

        $users = User::where('id_level', 3)->count();

        $dailysdReport = Dailysd::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailybpReport = Dailybp::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailyklReport = Dailykl::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $dailyicReport = Dailyic::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $evaluateReport = Evaluate::whereBetween('created_at', [
            Carbon::now()->format('Y-m-d 00:00:00'),
            Carbon::now()->format('Y-m-d 23:59:59')
        ])->get();
        $kalenderweekly = Weekly::all();

        $weekly = Weekly::where('id_divisi', $user->id_divisi)
            ->whereBetween('start_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get();

        $pengguna = User::where('id_level', 3)->get();

        foreach ($pengguna as $userCount) {
            $userId = $userCount->id;
            $dailysdCounts[$userId] = Dailysd::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->format('Y-m-d 00:00:00'),
                    Carbon::now()->format('Y-m-d 23:59:59')
                ])->count();

            $dailybpCounts[$userId] = Dailybp::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->format('Y-m-d 00:00:00'),
                    Carbon::now()->format('Y-m-d 23:59:59')
                ])->count();

            $dailyklCounts[$userId] = Dailykl::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->format('Y-m-d 00:00:00'),
                    Carbon::now()->format('Y-m-d 23:59:59')
                ])->count();

            $dailyicCounts[$userId] = Dailyic::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->format('Y-m-d 00:00:00'),
                    Carbon::now()->format('Y-m-d 23:59:59')
                ])->count();

            $dailyevCounts[$userId] = Evaluate::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->format('Y-m-d 00:00:00'),
                    Carbon::now()->format('Y-m-d 23:59:59')
                ])->count();
        }

        $viewData = [
            "title" => "Beranda",
            "userId" => $userId,
            "dailysdCounts" => $dailysdCounts,
            "dailybpCounts" => $dailybpCounts,
            "dailyklCounts" => $dailyklCounts,
            "dailyicCounts" => $dailyicCounts,
            "dailyevCounts" => $dailyevCounts,
            "user" => $user,
            "users" => $users,
            "weekly" => $weekly,
            "dailysd" => $dailysd,
            "dailybp" => $dailybp,
            "dailykl" => $dailykl,
            "dailyic" => $dailyic,
            "evaluate" => $evaluate,
            "divisi" => $divisi,
            "dailysdReport" => $dailysdReport,
            "dailybpReport" => $dailybpReport,
            "dailyklReport" => $dailyklReport,
            "dailyicReport" => $dailyicReport,
            "evaluateReport" => $evaluateReport,
            "pengguna" => $pengguna,
            "kalenderweekly" => $kalenderweekly
        ];

        if (Auth::guard('divisi')->user()) {
            $viewData['akundivisi'] = $akundivisi;
            $viewData['userDivisi'] = $userDivisi;
            $viewData['weeklyPlan'] = $weeklyPlan;
            $viewData['weeklyPlanCount'] = $weeklyPlanCount;
        }

        return view('dashboard', $viewData);
    }

    public function eventsUser()
    {
        $user = Auth::user();
        // $akundivisi = Akundivisi::where('id_divisi', $user->id_divisi)->first();

        $kalenderweekly = Weekly::where('id_divisi', $user->id_divisi)
            ->select('id', 'rencana as title', 'start_date as start', 'end_date as end')
            ->get()
            ->toArray();

        return response()->json($kalenderweekly);
    }

    public function showUser($id)
    {
        $kalenderweekly = Weekly::findOrFail($id);
        return response()->json($kalenderweekly);
    }


    public function events()
    {
        $akundivisi = Auth::guard('divisi')->user();
        $kalenderweekly = Weekly::where('id_akundivisi', $akundivisi->id)
            ->select('id', 'rencana as title', 'start_date as start', 'end_date as end')
            ->get()
            ->toArray();
        return response()->json($kalenderweekly);
    }
    public function show($id)
    {
        $kalenderweekly = Weekly::findOrFail($id);
        return response()->json($kalenderweekly);
    }
}
