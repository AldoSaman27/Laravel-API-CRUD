<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;

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

route::post("auth/register", [UserController::class,"register"]); // Done
route::post("auth/login", [UserController::class,"login"]); // Done
route::post("auth/logout", [UserController::class,"logout"]); // Done

// Kelas: Done
route::get("kelas/index", [KelasController::class,"index"]); // Done
route::post("kelas/store", [KelasController::class,"store"]); // Done
route::get("kelas/show/{id}", [KelasController::class,"show"]); // Done
route::post("kelas/update/{id}", [KelasController::class,"update"]); // Done
route::delete("kelas/destroy/{id}", [KelasController::class,"destroy"]); // Done

// Spp: Done
route::get("spp/index", [SppController::class,"index"]); // Done
route::post("spp/store", [SppController::class,"store"]); // Done
route::get("spp/show/{id}", [SppController::class,"show"]); // Done
route::post("spp/update/{id}", [SppController::class,"update"]); // Done
route::delete("spp/destroy/{id}", [SppController::class,"destroy"]); // Done

// Siswa: Done
route::get("siswa/index", [SiswaController::class,"index"]); // Done
route::post("siswa/store", [SiswaController::class,"store"]); // Done
route::get("siswa/show/{id}", [SiswaController::class,"show"]); // Done
route::post("siswa/update/{id}", [SiswaController::class,"update"]); // Done
route::delete("siswa/destroy/{id}", [SiswaController::class,"destroy"]); // Done

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
