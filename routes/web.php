<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\TeamController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/team/create', [App\Http\Controllers\TeamController::class, 'create'])->name('team.create');
Route::put('/team/create', [App\Http\Controllers\TeamController::class, 'store'])->name('team.store');
Route::get('/teams', [App\Http\Controllers\TeamController::class, 'index'])->name('team.index');
Route::get('/matcher', [App\Http\Controllers\TeamController::class, 'showMatcher'])->name('team.showmatcher');
Route::put('/matcher', [App\Http\Controllers\TeamController::class, 'matcher'])->name('team.matcher');
Route::get('/team/{team}', [App\Http\Controllers\TeamController::class, 'show'])->name('team.show');

Route::get('/match/create', [App\Http\Controllers\MatchController::class, 'create'])->name('match.create');
Route::get('/matches', [App\Http\Controllers\MatchController::class, 'index'])->name('match.index');
Route::post('/matches', [App\Http\Controllers\MatchController::class, 'sort'])->name('match.sort');
Route::put('/match/create', [App\Http\Controllers\MatchController::class, 'store'])->name('match.store');

Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
