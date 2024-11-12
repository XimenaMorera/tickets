<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SoporteController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

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
    Route::get('/register', [RegisteredUserController::class, 'create']);

});

Route::middleware('auth')->group(function () {
Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');
Route::put('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');  
Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');

// Route::get('/usuarios', [UserController::class, 'index']) ->middleware(CheckRole::class . ':administrador')->name('usuarios.index');
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');  
Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');

Route::get('/soporte', [SoporteController::class, 'index'])->name('soporte.index');
Route::put('/soporte/{ticket}', [SoporteController::class, 'update'])->name('soporte.update');  
Route::get('/soporte/{ticket}/edit', [SoporteController::class, 'edit'])->name('soporte.edit');
}); 

require __DIR__.'/auth.php';
