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
// use App\Http\Controllers\IntervalController;
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


// Route::get('/', function () {
//     return view('dashboard');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [ProfileController::class, 'updatePicture'])->name('profile.store');
    Route::get('profile/edit', [ProfileController::class, 'editData'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'updateData'])->name('profile.update');

    Route::group(['middleware' => ['cekUserLogin:1,2']], function () {
    });

    Route::group(['middleware' => ['cekUserLogin:3']], function () {
        // Route::group(['prefix' => 'selfdevelopment'], function () {
        //     Route::get('newsd', function () {
        //         return view('daily.selfdevelopment.new');
        //     });
        //     Route::get('historysd', function () {
        //         return view('daily.selfdevelopment.history');
        //     });
        // });
        Route::get('historysd', [DailysdController::class, 'index'])->name('historysd');
        Route::get('newsd', [DailysdController::class, 'create'])->name('newsd');
        Route::post('newsd/store', [DailysdController::class, 'store'])->name('newsd.store');
        Route::get('historysd/edit/{id}', [DailysdController::class, 'edit'])->name('historysd.edit');
        Route::post('historysd/update/{id}', [DailysdController::class, 'update'])->name('historysd.update');
        // Route::resource('selfdevelopment', DailysdController::class)->only(['store', 'update', 'destroy']);

        Route::get('historybp', [DailybpController::class, 'index'])->name('historybp');
        Route::get('newbp', [DailybpController::class, 'create'])->name('newbp');
        Route::post('newbp/store', [DailybpController::class, 'store'])->name('newbp.store');
        Route::get('historybp/edit/{id}', [DailybpController::class, 'edit'])->name('historybp.edit');
        Route::post('historybp/update/{id}', [DailybpController::class, 'update'])->name('historybp.update');
        // Route::group(['prefix' => 'bisnisprofit'], function () {
        //     Route::get('newbp', function () {
        //         return view('daily.bisnisprofit.new');
        //     });
        //     Route::get('historybp', function () {
        //         return view('daily.bisnisprofit.history');
        //     });
        // });

        // Route::group(['prefix' => 'kelembagaan'], function () {
        //     Route::get('newkl', function () {
        //         return view('daily.kelembagaan.new');
        //     });
        //     Route::get('historykl', function () {
        //         return view('daily.kelembagaan.history');
        //     });
        // });
        Route::get('historykl', [DailyklController::class, 'index'])->name('historykl');
        Route::get('newkl', [DailyklController::class, 'create'])->name('newkl');
        Route::post('newkl/store', [DailyklController::class, 'store'])->name('newkl.store');
        Route::get('historykl/edit/{id}', [DailyklController::class, 'edit'])->name('historykl.edit');
        Route::post('historykl/update/{id}', [DailyklController::class, 'update'])->name('historykl.update');

        Route::group(['prefix' => 'inovasicreativity'], function () {
            Route::get('newic', function () {
                return view('daily.inovasicreativity.new');
            });
            Route::get('historyic', function () {
                return view('daily.inovasicreativity.history');
            });
        });

        // Route::group(['prefix' => 'evaluasi'], function () {
        //     Route::get('newev', function () {
        //         return view('daily.evaluasi.new');
        //     });
        //     Route::get('historyev', function () {
        //         return view('daily.evaluasi.history');
        //     });
        // });
        Route::get('historyic', [DailyicController::class, 'index'])->name('historyic');
        Route::get('newic', [DailyicController::class, 'create'])->name('newic');
        Route::post('newic/store', [DailyicController::class, 'store'])->name('newic.store');
        Route::get('historyic/edit/{id}', [DailyicController::class, 'edit'])->name('historyic.edit');
        Route::post('historyic/update/{id}', [DailyicController::class, 'update'])->name('historyic.update');

        // Route::group(['prefix' => 'interval'], function () {
        //     Route::get('newinterval', function () {
        //         return view('pages.interval.newinterval');
        //     });
        //     Route::get('editinterval', function () {
        //         return view('pages.interval.editinterval');
        //     });
        //     Route::get('deleteinterval', function () {
        //         return view('pages.interval.deleteinterval');
        //     });
        // });

        Route::get('historyev', [EvaluateController::class, 'index'])->name('historyev');
        Route::get('newev', [EvaluateController::class, 'create'])->name('newev');
        Route::post('newev/store', [EvaluateController::class, 'store'])->name('newev.store');
        Route::get('historyev/edit/{id}', [EvaluateController::class, 'edit'])->name('historyev.edit');
        Route::post('historyev/update/{id}', [EvaluateController::class, 'update'])->name('historyev.update');

        Route::resource('interval', IntervalController::class)->only(['store', 'update', 'destroy']);
        // Route::post('interval/store', [IntervalController::class, 'store'])->name('interval.store');
        // Route::get('interval', [IntervalController::class, 'interval'])->name('interval');
        // Route::get('interval/create', [IntervalController::class, 'create'])->name('interval.create');
        // Route::get('interval/edit', [IntervalController::class, 'edit'])->name('interval.edit');
        // Route::put('interval', [IntervalController::class, 'update'])->name('interval.update');
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
