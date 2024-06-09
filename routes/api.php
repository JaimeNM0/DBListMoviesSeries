<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValuationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('users', UserController::class);
Route::apiResource('series', SerieController::class);
Route::apiResource('movies', MovieController::class);
Route::apiResource('chapters', ChapterController::class);
Route::apiResource('actors', ActorController::class);

Route::apiResource('valuations', ValuationController::class);
Route::get('valuations/{id}/user', [ValuationController::class, 'getValuationUser']);
Route::get('valuations/{id}/content', [ValuationController::class, 'getValuationContent']);

Route::get('users/{id}/valuations', [UserController::class, 'getUserValuations']);