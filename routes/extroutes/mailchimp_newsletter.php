<?php

use App\Http\Controllers\Mailchimp\NewsletterController;

Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::resource('mailchimp-newsletter', NewsletterController::class)->only(['index', 'store']);
    });
});

