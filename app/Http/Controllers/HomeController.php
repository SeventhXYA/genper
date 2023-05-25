<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Dailysd;
use App\Dailybp;
use App\Dailykl;
use App\Dailyic;
use App\Evaluate;
use App\IntervalBp;
use App\IntervalIc;
use App\IntervalKl;
use App\IntervalOthers;
use App\IntervalSd;
use App\Longtermtarget;
use App\Interval;
use App\User;
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
        // $dailysd = Dailysd::whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailybp = Dailybp::whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailykl = Dailykl::whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailyic = Dailyic::whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $evaluate = Evaluate::whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();

        // $dailysduser = Dailysd::where('user_id', Auth::user()->id)->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailybpuser = Dailybp::where('user_id', Auth::user()->id)->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailykluser = Dailykl::where('user_id', Auth::user()->id)->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $dailyicuser = Dailyic::where('user_id', Auth::user()->id)->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();
        // $evaluateuser = Evaluate::where('user_id', Auth::user()->id)->whereBetween('created_at', [
        //     Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')
        // ])->count();

        $user = Auth::user();
        // $pomodoro = User::where('level_id', 3)->get();
        // $users = User::where('level_id', 3)->get();

        // Carbon::setWeekStartsAt(Carbon::SUNDAY);
        // Carbon::setWeekEndsAt(Carbon::SATURDAY);
        // $weeklysd = Weeklysd::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        // $weeklybp = Weeklybp::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        // $weeklykl = Weeklykl::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        // $weeklyic = Weeklyic::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        // return view('index', [
        //     "title" => "Beranda"
        // ], compact('users', 'user', 'ltt_pending', 'ltt_approve', 'ltt_decline', 'dailysd', 'dailybp', 'dailykl', 'dailyic', 'dailysduser', 'dailybpuser', 'dailykluser', 'dailyicuser',  'ltt_pendinguser', 'ltt_approveuser', 'ltt_declineuser', 'pomodoro', 'evaluate', 'evaluateuser'));
        return view('dashboard', [
            "title" => "Beranda"
        ], compact('user'));
    }
    public function create()
    {
        $users = User::where('id', Auth::user()->id)->get();
        $interval = Interval::where('id', Auth::user()->id)->get();

        return view('pomodoro.pomodororeport', [
            "title" => "Interval Pomodoro",
        ], compact('users', 'interval'));
    }
    public function interval()
    {
        $user = Auth::user();

        return view('pomodoro.pomodoro', [
            "title" => "Interval Pomodoro",
        ], compact('user'));
    }
}
