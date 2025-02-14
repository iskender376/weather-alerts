<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherAlert;
use Illuminate\Support\Facades\Auth;

class WeatherAlertController extends Controller
{

    // Get all user notifications
    public function index()
    {
        return response()->json(Auth::user()->weatherAlerts);
    }

    // Create new notification
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string',
            'threshold_precipitation' => 'required|numeric',
            'threshold_uv' => 'required|numeric',
        ]);

        $alert = Auth::user()->weatherAlerts()->create($validated);

        return response()->json($alert, 201);
    }

    // Delete notification
    public function destroy(WeatherAlert $alert)
    {
        if ($alert->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $alert->delete();

        return response()->json(null, 204);
    }
}
