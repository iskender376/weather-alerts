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
    Route::post('/push/subscribe', function (Request $request) {
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->keys['p256dh'],
            $request->keys['auth']
        );

        return response()->json(['message' => 'Subscribed successfully']);
    });

    Route::post('/push/unsubscribe', function (Request $request) {
        $request->user()->deletePushSubscription($request->endpoint);

        return response()->json(['message' => 'Unsubscribed successfully']);
    });
});
