<?php

use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TruckController::class, 'index'])->name('home');
Route::resource('trucks', TruckController::class);
Route::post('/trucks/{truck}/assign-subunit', [TruckController::class, 'assignSubunit'])->name('trucks.assignSubunit');
Route::get('/trucks/{id}/create-subunit', [TruckController::class, 'createSubunit'])->name('trucks.createSubunit');
Route::delete('/trucks/{truck}/subunit/{subunit}', [TruckController::class, 'removeSubunit'])->name('trucks.removeSubunit');

