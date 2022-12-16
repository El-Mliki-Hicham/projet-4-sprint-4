<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('AvancementGroups/{id}', [DashboardController::class,'AvancementGroups'])->name('AvancementGroups');
Route::get('getGroupe/{id}', [DashboardController::class,'getGroupe'])->name('getGroupe');
Route::get('anne_formation/{id}', [DashboardController::class,'anne_formation'])->name('anne_formation');
Route::get('Groupe/{id}', [DashboardController::class,'Groupe'])->name('Groupe');
Route::get('formateur', [DashboardController::class,'formateur'])->name('formateur');
Route::get('Av_ApprenantTache/{idF}/{idB}', [DashboardController::class,'Av_ApprenantTache'])->name('Av_ApprenantTache');
