<?php

use App\Http\Controllers\Common\MenuController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
    ],
], function () {
    Route::prefix('dashboard/admin')
        ->middleware(['auth', 'admin'])
        ->name('dashboard.admin.menu.')
        ->controller(MenuController::class)
        ->group(function () {
            Route::get('menu', 'index')->name('index');
            Route::get('menu/{menu}/delete', 'delete')->name('delete');
            Route::any('menu/{menu}/status', 'status')->name('status');
            Route::post('menu/{menu}/{type}', 'update')->name('update');
            Route::any('menu/order', 'order')->name('order');
            Route::post('menu', 'store')->name('store');
        });
});
