<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');
Route::put('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');  
Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');  
Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
}); 

require __DIR__.'/auth.php';
