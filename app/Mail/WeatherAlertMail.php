<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\WeatherAlert;

class WeatherAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $alert;

    /**
     * Create a new message instance.
     */
    public function __construct(WeatherAlert $alert)
    {
        $this->alert = $alert;
    }

    public function build()
    {
        return $this->subject('Weather Alert: Dangerous Conditions')
            ->view('emails.weather_alert');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Weather Alert Mail',
        );
    }
}
