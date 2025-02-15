<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WeatherAlert;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeatherAlertMail;
use App\Notifications\WeatherPushNotification;

class CheckWeather extends Command
{
    protected $signature = 'weather:check';
    protected $description = 'Check weather conditions and notify users if thresholds are exceeded';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(WeatherService $weatherService)
    {
        $alerts = WeatherAlert::all();

        foreach ($alerts as $alert) {
            $weather = $weatherService->getWeather($alert->city);

//            if (isset($weather['rain']['1h']) && $weather['rain']['1h'] > $alert->threshold_precipitation ||
//                isset($weather['uvi']) && $weather['uvi'] > $alert->threshold_uv) {

                Mail::to($alert->user->email)->send(new WeatherAlertMail($alert));
                $alert->user->notify(new WeatherPushNotification());
                $this->info("WebPush sent and Notification sent to {$alert->user->email}");
           // }
        }
    }
}
