<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingFormController;

Route::get('/', function () {
    return redirect()->route('desert-excursion.show');
});

Route::get('/booking/desert-excursion', [BookingFormController::class, 'showDesertExcursionForm'])->name('desert-excursion.show');
Route::post('/booking/desert-excursion', [BookingFormController::class, 'submitDesertExcursionForm'])->name('desert-excursion.submit');
Route::post('/booking/desert-excursion/complete', [BookingFormController::class, 'completeBooking'])->name('desert-excursion.complete');
Route::get('/booking/desert-excursion/success', [BookingFormController::class, 'showSuccessPage'])->name('desert-excursion.success');
