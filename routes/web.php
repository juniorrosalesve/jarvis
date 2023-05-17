<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [App\Http\Controllers\ClienteController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/nuevo-cliente', [App\Http\Controllers\ClienteController::class, 'add'])->middleware(['auth', 'verified'])->name('add');
Route::get('/eliminar-cliente/{id}', [App\Http\Controllers\ClienteController::class, 'remove'])->middleware(['auth', 'verified'])->name('remove');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
