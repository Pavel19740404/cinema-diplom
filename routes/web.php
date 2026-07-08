<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\SeanceController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\HallController as ClientHallController;
use App\Http\Controllers\Client\TicketController;

// Клиентская часть
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hall/{seance}', [ClientHallController::class, 'show'])->name('hall.show');
Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');

// Админка
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('halls', HallController::class);
    Route::resource('films', FilmController::class);
    Route::resource('seances', SeanceController::class);
});

require __DIR__.'/auth.php';
