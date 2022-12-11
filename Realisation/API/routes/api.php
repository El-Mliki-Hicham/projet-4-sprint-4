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
Route::get('ListApprenant/{id}', [GroupesController::class,'ListApprenant'])->name('ListApprenant');
Route::get('AvancementGroups/{id}', [GroupesController::class,'AvancementGroups'])->name('AvancementGroups');
Route::get('OneGroupe/{id}', [GroupesController::class,'OneGroupe'])->name('OneGroupe');
Route::resource('groupes', GroupesController::class);
Route::get('AllGroupes/{id}', [GroupesController::class,'showAllGroupes'])->name('AllGroupes');
Route::resource('formateur', FormateurController::class);


Route::get('ApprenantBrief/{idG}', [GroupesController::class,'ApprenantBrief'])->name('ApprenantBrief');

Route::get('Av_ApprenantTache/{idF}/{idG}/{idA}/{idB}', [GroupesController::class,'Av_ApprenantTache'])->name('Av_ApprenantTache');
Route::get('ApprenantsCount/{id}', [ApprenantController::class,'ApprenantsCount'])->name('ApprenantsCount');
Route::resource('anne', AnneeFormationController::class);
