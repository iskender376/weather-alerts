<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WeatherAlert;
use Illuminate\Support\Facades\Auth;

class WeatherAlerts extends Component
{
    public $city;
    public $threshold_precipitation;
    public $threshold_uv;

    public function addAlert()
    {
        $this->validate([
            'city' => 'required|string',
            'threshold_precipitation' => 'required|numeric',
            'threshold_uv' => 'required|numeric',
        ]);

        Auth::user()->weatherAlerts()->create([
            'city' => $this->city,
            'threshold_precipitation' => $this->threshold_precipitation,
            'threshold_uv' => $this->threshold_uv,
        ]);

        session()->flash('message', 'Weather alert added successfully.');

        $this->reset(['city', 'threshold_precipitation', 'threshold_uv']);
    }

    public function deleteAlert($id)
    {
        $alert = WeatherAlert::find($id);
        if ($alert && $alert->user_id === Auth::id()) {
            $alert->delete();
            session()->flash('message', 'Weather alert deleted.');
        }
    }
    public function render()
    {
        return view('livewire.weather-alerts', [
            'alerts' => Auth::user()->weatherAlerts,
        ]);
    }
}
