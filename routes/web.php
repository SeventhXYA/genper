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

use App\Http\Controllers\DailysdController;
use App\Http\Controllers\DailybpController;
use App\Http\Controllers\DailyklController;
use App\Http\Controllers\DailyicController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImplementasiController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WeeklyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('forget', [LoginController::class, 'forget'])->name('login.forget');
    Route::post('forget', [LoginController::class, 'sendResetEmail'])->name('login.sendemail');

    Route::get('reset', [LoginController::class, 'reset'])->name('reset');
    Route::post('reset', [LoginController::class, 'resetPassword'])->name('resetPassword');
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:web,divisi']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [ProfileController::class, 'updatePicture'])->name('profile.store');
    Route::get('profile/edit', [ProfileController::class, 'editData'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'updateData'])->name('profile.update');

    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::get('selfdevelopment/reportsd', [DailysdController::class, 'reportAdmin'])->name('reportsd');
        Route::delete('dailysd/delete/{dailysd}', [DailysdController::class, 'destroy'])->name('dailysd.delete');

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
        Route::delete('interval/delete/{interval}', [IntervalController::class, 'destroy'])->name('interval.delete');

        Route::get('weekly/list', [WeeklyController::class, 'indexAdmin'])->name('list');
        Route::get('/cetak-pdf', [PdfController::class, 'generatePdf'])->name('cetak-pdf');

        // Route::delete('weekly/delete/{weekly}', [WeeklyController::class, 'destroy'])->name('weekly.delete');
    });

    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::get('events', [HomeController::class, 'events'])->name('events');

        //menampilkan data kalender
        Route::get('events/{id}', [HomeController::class, 'show'])->name('show');

        Route::get('weekly/history', [WeeklyController::class, 'index'])->name('history');
        Route::delete('weekly/delete/{weekly}', [WeeklyController::class, 'destroy'])->name('weekly.delete');
        Route::post('weekly/store', [WeeklyController::class, 'store'])->name('weekly.store');
        Route::get('weekly/edit/{id}', [WeeklyController::class, 'edit'])->name('weekly.edit');
        Route::post('weekly/update/{id}', [WeeklyController::class, 'update'])->name('weekly.update');
    });

    Route::group(['middleware' => ['cekUserLogin:3']], function () {

        Route::get('historysd', [DailysdController::class, 'index'])->name('historysd');
        Route::get('newsd', [DailysdController::class, 'create'])->name('newsd');
        Route::post('newsd/store', [DailysdController::class, 'store'])->name('newsd.store');
        Route::get('historysd/edit/{id}', [DailysdController::class, 'edit'])->name('historysd.edit');
        Route::post('historysd/update/{id}', [DailysdController::class, 'update'])->name('historysd.update');

        Route::get('historybp', [DailybpController::class, 'index'])->name('historybp');
        Route::get('newbp', [DailybpController::class, 'create'])->name('newbp');
        Route::post('newbp/store', [DailybpController::class, 'store'])->name('newbp.store');
        Route::get('historybp/edit/{id}', [DailybpController::class, 'edit'])->name('historybp.edit');
        Route::post('historybp/update/{id}', [DailybpController::class, 'update'])->name('historybp.update');

        Route::get('historykl', [DailyklController::class, 'index'])->name('historykl');
        Route::get('newkl', [DailyklController::class, 'create'])->name('newkl');
        Route::post('newkl/store', [DailyklController::class, 'store'])->name('newkl.store');
        Route::get('historykl/edit/{id}', [DailyklController::class, 'edit'])->name('historykl.edit');
        Route::post('historykl/update/{id}', [DailyklController::class, 'update'])->name('historykl.update');

        Route::get('historyic', [DailyicController::class, 'index'])->name('historyic');
        Route::get('newic', [DailyicController::class, 'create'])->name('newic');
        Route::post('newic/store', [DailyicController::class, 'store'])->name('newic.store');
        Route::get('historyic/edit/{id}', [DailyicController::class, 'edit'])->name('historyic.edit');
        Route::post('historyic/update/{id}', [DailyicController::class, 'update'])->name('historyic.update');

        Route::get('historyev', [EvaluateController::class, 'index'])->name('historyev');
        Route::get('newev', [EvaluateController::class, 'create'])->name('newev');
        Route::post('newev/store', [EvaluateController::class, 'store'])->name('newev.store');
        Route::get('historyev/edit/{id}', [EvaluateController::class, 'edit'])->name('historyev.edit');
        Route::post('historyev/update/{id}', [EvaluateController::class, 'update'])->name('historyev.update');

        Route::post('interval/store', [IntervalController::class, 'store'])->name('interval.store');
        Route::post('interval/update/{id}', [IntervalController::class, 'update'])->name('interval.update');
        // Route::post('historyev/update/{id}', [EvaluateController::class, 'update'])->name('historyev.update');

        // Route::resource('interval', IntervalController::class)->only(['store', 'update', 'destroy']);
    });
});



Route::group(['prefix' => 'email'], function () {
    Route::get('inbox', function () {
        return view('pages.email.inbox');
    });
    Route::get('read', function () {
        return view('pages.email.read');
    });
    Route::get('compose', function () {
        return view('pages.email.compose');
    });
});

Route::group(['prefix' => 'apps'], function () {
    Route::get('chat', function () {
        return view('pages.apps.chat');
    });
    Route::get('calendar', function () {
        return view('pages.apps.calendar');
    });
});

Route::group(['prefix' => 'ui-components'], function () {
    Route::get('accordion', function () {
        return view('pages.ui-components.accordion');
    });
    Route::get('alerts', function () {
        return view('pages.ui-components.alerts');
    });
    Route::get('badges', function () {
        return view('pages.ui-components.badges');
    });
    Route::get('breadcrumbs', function () {
        return view('pages.ui-components.breadcrumbs');
    });
    Route::get('buttons', function () {
        return view('pages.ui-components.buttons');
    });
    Route::get('button-group', function () {
        return view('pages.ui-components.button-group');
    });
    Route::get('cards', function () {
        return view('pages.ui-components.cards');
    });
    Route::get('carousel', function () {
        return view('pages.ui-components.carousel');
    });
    Route::get('collapse', function () {
        return view('pages.ui-components.collapse');
    });
    Route::get('dropdowns', function () {
        return view('pages.ui-components.dropdowns');
    });
    Route::get('list-group', function () {
        return view('pages.ui-components.list-group');
    });
    Route::get('media-object', function () {
        return view('pages.ui-components.media-object');
    });
    Route::get('modal', function () {
        return view('pages.ui-components.modal');
    });
    Route::get('navs', function () {
        return view('pages.ui-components.navs');
    });
    Route::get('navbar', function () {
        return view('pages.ui-components.navbar');
    });
    Route::get('pagination', function () {
        return view('pages.ui-components.pagination');
    });
    Route::get('popovers', function () {
        return view('pages.ui-components.popovers');
    });
    Route::get('progress', function () {
        return view('pages.ui-components.progress');
    });
    Route::get('scrollbar', function () {
        return view('pages.ui-components.scrollbar');
    });
    Route::get('scrollspy', function () {
        return view('pages.ui-components.scrollspy');
    });
    Route::get('spinners', function () {
        return view('pages.ui-components.spinners');
    });
    Route::get('tabs', function () {
        return view('pages.ui-components.tabs');
    });
    Route::get('tooltips', function () {
        return view('pages.ui-components.tooltips');
    });
});

Route::group(['prefix' => 'advanced-ui'], function () {
    Route::get('cropper', function () {
        return view('pages.advanced-ui.cropper');
    });
    Route::get('owl-carousel', function () {
        return view('pages.advanced-ui.owl-carousel');
    });
    Route::get('sweet-alert', function () {
        return view('pages.advanced-ui.sweet-alert');
    });
});

Route::group(['prefix' => 'forms'], function () {
    Route::get('basic-elements', function () {
        return view('pages.forms.basic-elements');
    });
    Route::get('advanced-elements', function () {
        return view('pages.forms.advanced-elements');
    });
    Route::get('editors', function () {
        return view('pages.forms.editors');
    });
    Route::get('wizard', function () {
        return view('pages.forms.wizard');
    });
});

Route::group(['prefix' => 'charts'], function () {
    Route::get('apex', function () {
        return view('pages.charts.apex');
    });
    Route::get('chartjs', function () {
        return view('pages.charts.chartjs');
    });
    Route::get('flot', function () {
        return view('pages.charts.flot');
    });
    Route::get('morrisjs', function () {
        return view('pages.charts.morrisjs');
    });
    Route::get('peity', function () {
        return view('pages.charts.peity');
    });
    Route::get('sparkline', function () {
        return view('pages.charts.sparkline');
    });
});

Route::group(['prefix' => 'tables'], function () {
    Route::get('basic-tables', function () {
        return view('pages.tables.basic-tables');
    });
    Route::get('data-table', function () {
        return view('pages.tables.data-table');
    });
});

Route::group(['prefix' => 'icons'], function () {
    Route::get('feather-icons', function () {
        return view('pages.icons.feather-icons');
    });
    Route::get('flag-icons', function () {
        return view('pages.icons.flag-icons');
    });
    Route::get('mdi-icons', function () {
        return view('pages.icons.mdi-icons');
    });
});

Route::group(['prefix' => 'general'], function () {
    Route::get('blank-page', function () {
        return view('pages.general.blank-page');
    });
    Route::get('faq', function () {
        return view('pages.general.faq');
    });
    Route::get('invoice', function () {
        return view('pages.general.invoice');
    });
    Route::get('profile', function () {
        return view('pages.general.profile');
    });
    Route::get('pricing', function () {
        return view('pages.general.pricing');
    });
    Route::get('timeline', function () {
        return view('pages.general.timeline');
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', function () {
        return view('pages.auth.login');
    });
    Route::get('register', function () {
        return view('pages.auth.register');
    });
});

Route::group(['prefix' => 'error'], function () {
    Route::get('404', function () {
        return view('pages.error.404');
    });
    Route::get('500', function () {
        return view('pages.error.500');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}', function () {
    return View::make('pages.error.404');
})->where('page', '.*');