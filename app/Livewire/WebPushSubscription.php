<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class WebPushSubscription extends Component
{
    public $subscription;

    public function subscribe()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to subscribe to notifications.');
            return;
        }
        $this->dispatch('subscribe-webpush');
    }

    #[On('saveSubscription')] // Registering event handler in Livewire 3
    public function saveSubscription(...$args) // Receiving all passed arguments
    {
        Log::info("saveSubscription triggered! Arguments:", $args);

        if (empty($args)) {
            Log::error("Error: Subscription data not received!");
            return;
        }

        // Livewire passes `subscription` as the first argument in the array
        $subscriptionData = $args[0];

        if (!$subscriptionData || !is_array($subscriptionData)) {
            Log::error("Error: `subscriptionData` is invalid!", ['subscriptionData' => json_encode($subscriptionData)]);
            return;
        }

        // Wrapping `subscription` inside the expected structure
        $subscription = [
            'subscription' => $subscriptionData
        ];

        if (!isset($subscription['subscription']['endpoint'])) {
            Log::error("Error: `endpoint` is missing in `subscriptionData`!", ['subscriptionData' => $subscription]);
            return;
        }

        $user = Auth::user();
        if (!$user) {
            Log::error("Error: User not found!");
            return;
        }

        Log::info("Saving WebPush subscription for user ID: " . $user->id);

        // Updating the push subscription for the authenticated user
        $user->updatePushSubscription(
            $subscription['subscription']['endpoint'],
            $subscription['subscription']['keys']['p256dh'],
            $subscription['subscription']['keys']['auth']
        );

        Log::info("WebPush subscription successfully saved for user ID: " . $user->id);
    }



    public function render()
    {
        return view('livewire.web-push-subscription');
    }
}
