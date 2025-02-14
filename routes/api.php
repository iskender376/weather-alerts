<?php

use App\Http\Controllers\WeatherAlertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/alerts', [WeatherAlertController::class, 'index']);
    Route::post('/alerts', [WeatherAlertController::class, 'store']);
    Route::delete('/alerts/{alert}', [WeatherAlertController::class, 'destroy']);
    Route::get('/weather/{city}', [WeatherAlertController::class, 'getWeatherData']);
});
