self.addEventListener('push', function(event) {
    var data = event.data.json();

    event.waitUntil(
        self.registration.showNotification(data.title, {
            body: data.body,
            icon: '/icon.png',
            data: data,
            actions: [
                { action: 'view_alert', title: 'View Alert' }
            ]
        })
    );
});
