<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ClanController;

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
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('heroes/search', [HeroController::class, 'index'])->name('heroes.search');
    Route::resource('heroes', HeroController::class)->parameters([
        'heroes' => 'id'
    ]);

    Route::resource('clans', ClanController::class)->parameters([
        'clans' => 'id'
    ]);
});

require __DIR__.'/auth.php';
