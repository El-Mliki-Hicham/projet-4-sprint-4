<?php

use App\Http\Controllers\AnneeFormationController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\GroupesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('groupes', GroupesController::class);
Route::get('AllGroupes/{id}', [GroupesController::class,'showAllGroupes'])->name('AllGroupes');
Route::get('OneGroupe/{id}', [GroupesController::class,'OneGroupe'])->name('OneGroupe');
Route::get('ApprenantBrief/{idF}/{idG}', [GroupesController::class,'ApprenantBrief'])->name('ApprenantBrief');
Route::get('ApprenantsCount/{id}', [ApprenantController::class,'ApprenantsCount'])->name('ApprenantsCount');
Route::resource('formateur', FormateurController::class);
Route::resource('anne', AnneeFormationController::class);
