<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AssignerController;
use App\Http\Controllers\briefController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TasksController;
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




// Route::resource('brief',briefController::class);


// Route::resource('student',StudentController::class);

// Route::resource('assigner',AssignerController::class);


// Route::resource('promotion',PromotionController::class);
Route::resource('task',TasksController::class);


// // student controller
// Route::get('/student/index',[StudentController::class,'index'])->name('student.index');
// Route::get('/student/{id}',[StudentController::class,'show'])->name('student.show');
// Route::get('/student/create/{id}',[StudentController::class,'create'])->name('student.create');
// Route::post('/student/store',[StudentController::class,'store'])->name('student.store');
// Route::get('/student/Edit/{id}',[StudentController::class,'edit'])->name('student.edit');
// Route::put('/student/update/{id}',[StudentController::class,'update'])->name('student.update');
// Route::delete('/student/Delete/{id}',[StudentController::class,'destroy'])->name('student.destroy');

