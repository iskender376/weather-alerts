<div>


    @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Livewire.on('subscribe-webpush', function () {
                console.log("WebPush event received");

                Notification.requestPermission().then(function (permission) {
                    if (permission === 'granted') {
                        navigator.serviceWorker.ready.then(function (registration) {
                            registration.pushManager.subscribe({
                                userVisibleOnly: true,
                                applicationServerKey: "BAgqntv3eb9_qAnSrLs5lTfbUXEWzxwN8XjWqppy-80lBBXRh_IB6TQdePeLpaY69cOhHHKuh6vpsSBeopGfqFo"
                            }).then(function (subscription) {
                                console.log("Subscribed successfully:", subscription);

                                // Используем dispatch для Livewire 3
                                Livewire.dispatch('saveSubscription', { subscription: subscription.toJSON() });
                            }).catch(function (error) {
                                console.error('Error subscribing:', error);
                            });
                        });
                    }
                });
            });
        });
    </script>
</div>
