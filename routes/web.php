<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AkundivisiController;
use App\Http\Controllers\DailysdController;
use App\Http\Controllers\DailybpController;
use App\Http\Controllers\DailyklController;
use App\Http\Controllers\DailyicController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImplementasiController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\KgkoperasiController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeeklyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('forget', [LoginController::class, 'forget'])->name('forget');
    Route::post('forget', [LoginController::class, 'sendResetEmail'])->name('sendemail');

    Route::get('reset', [LoginController::class, 'reset'])->name('reset');
    Route::post('reset', [LoginController::class, 'resetPassword'])->name('resetPassword');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:web,divisi']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::get('user/list', [UserController::class, 'index'])->name('user.list');
        Route::get('user/new', [UserController::class, 'create'])->name('user.new');
        Route::post('user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('user/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
        Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

        Route::get('akundivisi/add/{id}', [AkundivisiController::class, 'create'])->name('akundivisi.add');
        Route::post('akundivisi/store', [AkundivisiController::class, 'store'])->name('akundivisi.store');
        Route::get('akundivisi/edit/{id}', [AkundivisiController::class, 'edit'])->name('akundivisi.edit');
        Route::post('akundivisi/update/{id}', [AkundivisiController::class, 'update'])->name('akundivisi.update');
        Route::delete('akundivisi/delete/{akundivisi}', [AkundivisiController::class, 'destroy'])->name('akundivisi.delete');

        // Route::get('akundivisi/list', [AkundivisiController::class, 'index'])->name('akundivisi.list');
        // Route::get('akundivisi/new', [AkundivisiController::class, 'create'])->name('akundivisi.new');
        // Route::get('akundivisi/edit/{id}', [AkundivisiController::class, 'edit'])->name('akundivisi.edit');
        // Route::get('akundivisi/detail/{id}', [AkundivisiController::class, 'detail'])->name('akundivisi.detail');
        // Route::post('akundivisi/update/{id}', [AkundivisiController::class, 'update'])->name('akundivisi.update');
        // Route::delete('akundivisi/delete/{akundivisi}', [AkundivisiController::class, 'destroy'])->name('akundivisi.delete');

        Route::get('divisi/list', [DivisiController::class, 'index'])->name('divisi.list');
        Route::post('divisi/store', [DivisiController::class, 'store'])->name('divisi.store');
        Route::post('divisi/update/{id}', [DivisiController::class, 'update'])->name('divisi.update');
        Route::delete('divisi/delete/{divisi}', [DivisiController::class, 'destroy'])->name('divisi.delete');

        Route::get('selfdevelopment/reportsd', [DailysdController::class, 'reportAdmin'])->name('reportsd');
        Route::delete('dailysd/delete/{dailysd}', [DailysdController::class, 'destroy'])->name('dailysd.delete');
        Route::get('/cetak-dailysd', [PdfController::class, 'generatePdfSd'])->name('cetak-dailysd');

        Route::get('bisnisprofit/reportbp', [DailybpController::class, 'reportAdmin'])->name('reportbp');
        Route::delete('dailybp/delete/{dailybp}', [DailybpController::class, 'destroy'])->name('dailybp.delete');

        Route::get('kelembagaan/reportkl', [DailyklController::class, 'reportAdmin'])->name('reportkl');
        Route::delete('dailykl/delete/{dailykl}', [DailyklController::class, 'destroy'])->name('dailykl.delete');

        Route::get('inovasicreativity/reportic', [DailyicController::class, 'reportAdmin'])->name('reportic');
        Route::delete('dailyic/delete/{dailyic}', [DailyicController::class, 'destroy'])->name('dailyic.delete');

        Route::get('evaluasi/reportev', [EvaluateController::class, 'reportAdmin'])->name('reportev');
        Route::delete('evaluasi/delete/{evaluasi}', [EvaluateController::class, 'destroy'])->name('evaluasi.delete');

        Route::get('interval/reportinterval', [IntervalController::class, 'reportAdmin'])->name('reportinterval');
        Route::delete('interval/delete/{interval}', [IntervalController::class, 'destroy'])->name('interval.delete');

        Route::get('implementasi/history', [ImplementasiController::class, 'index'])->name('implementasi.history');
        Route::get('implementasi/new', [ImplementasiController::class, 'create'])->name('implementasi.new');
        Route::post('implementasi/store', [ImplementasiController::class, 'store'])->name('implementasi.store');
        Route::get('implementasi/edit/{id}', [ImplementasiController::class, 'edit'])->name('implementasi.edit');
        Route::post('implementasi/update/{id}', [ImplementasiController::class, 'update'])->name('implementasi.update');
        Route::delete('implementasi/delete/{implementasi}', [ImplementasiController::class, 'destroy'])->name('implementasi.delete');

        Route::get('kgkoperasi/history', [KgkoperasiController::class, 'index'])->name('kgkoperasi.history');
        Route::get('kgkoperasi/new', [KgkoperasiController::class, 'create'])->name('kgkoperasi.new');
        Route::post('kgkoperasi/store', [KgkoperasiController::class, 'store'])->name('kgkoperasi.store');
        Route::get('kgkoperasi/edit/{id}', [KgkoperasiController::class, 'edit'])->name('kgkoperasi.edit');
        Route::post('kgkoperasi/update/{id}', [KgkoperasiController::class, 'update'])->name('kgkoperasi.update');
        Route::delete('kgkoperasi/delete/{kgkoperasi}', [KgkoperasiController::class, 'destroy'])->name('kgkoperasi.delete');

        Route::get('monitoring/history', [MonitoringController::class, 'index'])->name('monitoring.history');
        Route::get('monitoring/new', [MonitoringController::class, 'create'])->name('monitoring.new');
        Route::post('monitoring/store', [MonitoringController::class, 'store'])->name('monitoring.store');
        Route::get('monitoring/edit/{id}', [MonitoringController::class, 'edit'])->name('monitoring.edit');
        Route::post('monitoring/update/{id}', [MonitoringController::class, 'update'])->name('monitoring.update');
        Route::delete('monitoring/delete/{monitoring}', [MonitoringController::class, 'destroy'])->name('monitoring.delete');

        Route::get('weekly/list', [WeeklyController::class, 'indexAdmin'])->name('list');
        Route::get('/cetak-pdf', [PdfController::class, 'generatePdf'])->name('cetak-pdf');

        // Route::delete('weekly/delete/{weekly}', [WeeklyController::class, 'destroy'])->name('weekly.delete');
    });

    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::get('events', [HomeController::class, 'events'])->name('events');

        Route::get('events/{id}', [HomeController::class, 'show'])->name('show');

        Route::get('weekly/history', [WeeklyController::class, 'index'])->name('history');
        Route::delete('weekly/delete/{weekly}', [WeeklyController::class, 'destroy'])->name('weekly.delete');
        Route::post('weekly/store', [WeeklyController::class, 'store'])->name('weekly.store');
        Route::get('weekly/edit/{id}', [WeeklyController::class, 'edit'])->name('weekly.edit');
        Route::post('weekly/update/{id}', [WeeklyController::class, 'update'])->name('weekly.update');
    });

    Route::group(['middleware' => ['cekUserLogin:3']], function () {

        Route::get('eventsUser', [HomeController::class, 'eventsUser'])->name('eventsUser');
        Route::get('eventsUser/{id}', [HomeController::class, 'showUser'])->name('showUser');

        Route::get('selfdevelopment/historysd', [DailysdController::class, 'index'])->name('selfdevelopment.historysd');
        Route::get('selfdevelopment/newsd', [DailysdController::class, 'create'])->name('selfdevelopment.newsd');
        Route::post('selfdevelopment/store', [DailysdController::class, 'store'])->name('selfdevelopment.store');
        Route::get('selfdevelopment/edit/{id}', [DailysdController::class, 'edit'])->name('selfdevelopment.edit');
        Route::post('selfdevelopment/update/{id}', [DailysdController::class, 'update'])->name('selfdevelopment.update');

        Route::get('bisnisprofit/historybp', [DailybpController::class, 'index'])->name('bisnisprofit.historybp');
        Route::get('bisnisprofit/newbp', [DailybpController::class, 'create'])->name('bisnisprofit.newbp');
        Route::post('bisnisprofit/store', [DailybpController::class, 'store'])->name('bisnisprofit.store');
        Route::get('bisnisprofit/edit/{id}', [DailybpController::class, 'edit'])->name('bisnisprofit.edit');
        Route::post('bisnisprofit/update/{id}', [DailybpController::class, 'update'])->name('bisnisprofit.update');

        Route::get('kelembagaan/historykl', [DailyklController::class, 'index'])->name('kelembagaan.historykl');
        Route::get('kelembagaan/newkl', [DailyklController::class, 'create'])->name('kelembagaan.newkl');
        Route::post('kelembagaan/store', [DailyklController::class, 'store'])->name('kelembagaan.store');
        Route::get('kelembagaan/edit/{id}', [DailyklController::class, 'edit'])->name('kelembagaan.edit');
        Route::post('kelembagaan/update/{id}', [DailyklController::class, 'update'])->name('kelembagaan.update');

        Route::get('inovasicreativity/historyic', [DailyicController::class, 'index'])->name('inovasicreativity.historyic');
        Route::get('inovasicreativity/newic', [DailyicController::class, 'create'])->name('inovasicreativity.newic');
        Route::post('inovasicreativity/store', [DailyicController::class, 'store'])->name('inovasicreativity.store');
        Route::get('inovasicreativity/edit/{id}', [DailyicController::class, 'edit'])->name('inovasicreativity.edit');
        Route::post('inovasicreativity/update/{id}', [DailyicController::class, 'update'])->name('inovasicreativity.update');

        Route::get('evaluasi/historyev', [EvaluateController::class, 'index'])->name('evaluasi.historyev');
        Route::get('evaluasi/newev', [EvaluateController::class, 'create'])->name('evaluasi.newev');
        Route::post('evaluasi/store', [EvaluateController::class, 'store'])->name('evaluasi.store');
        Route::get('evaluasi/edit/{id}', [EvaluateController::class, 'edit'])->name('evaluasi.edit');
        Route::post('evaluasi/update/{id}', [EvaluateController::class, 'update'])->name('evaluasi.update');

        Route::post('interval/store', [IntervalController::class, 'store'])->name('interval.store');
        Route::post('interval/update/{id}', [IntervalController::class, 'update'])->name('interval.update');
        // Route::post('historyev/update/{id}', [EvaluateController::class, 'update'])->name('historyev.update');

        // Route::resource('interval', IntervalController::class)->only(['store', 'update', 'destroy']);
    });
});

// 404 for undefined routes
Route::any('/{page?}', function () {
    return View::make('pages.error.404');
})->where('page', '.*');
