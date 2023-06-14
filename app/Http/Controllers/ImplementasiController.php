<?php

namespace App\Http\Controllers;

use App\Implementasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImplementasiController extends Controller
{
    public function index()
    {
        $implementasi = Implementasi::orderBy('id', 'DESC')->get();
        // $implementasiMobile = Implementasi::orderBy('id', 'DESC')->simplePaginate(6);
        return view('logadmin.monthly.implementasi.history', [
            "title" => "Implementasi",
            "sub" => "Riwayat",
        ], compact('implementasi'));
    }

    public function create()
    {
        $user = User::all();
        return view('logadmin.monthly.implementasi.new', [
            "title" => "Daily Report Self-Development"
        ], compact('user'));
    }
}
