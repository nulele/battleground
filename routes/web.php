<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/heroes', [HeroController::class, 'index'])->middleware(['auth'])->name('heroes.index');
Route::get('/heroes/create', [HeroController::class, 'create'])->middleware(['auth'])->name('heroes.create');
Route::post('/heroes', [HeroController::class, 'store'])->middleware(['auth'])->name('heroes.store');
Route::get('/heroes/{id}/edit', [HeroController::class, 'edit'])->middleware(['auth'])->name('heroes.edit');
Route::put('/heroes/{id}', [HeroController::class, 'update'])->middleware(['auth'])->name('heroes.update');
Route::delete('/heroes/{id}', [HeroController::class, 'destroy'])->middleware(['auth'])->name('heroes.delete');

require __DIR__.'/auth.php';
