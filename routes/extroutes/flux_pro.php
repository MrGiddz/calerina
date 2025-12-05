<?php

use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/admin/settings')
    ->middleware(['auth', 'admin'])
    ->name('dashboard.admin.settings.')->group(function () {
        Route::get('fal-ai', [SettingsController::class, 'falAi'])->name('fal-ai');
        Route::get('fal-ai/test', [SettingsController::class, 'falAiTest'])->name('fal-ai.test');
        Route::post('fal-ai', [SettingsController::class, 'falAiSave']);
    });
