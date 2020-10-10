class Notific {
    constructor() {
        this.notify();
    }

    notify() {
        if (!("Notification" in window)) {
            alert("This browser does not support desktop notification");
        } else if (Notification.permission === "granted") {
            // If it's okay let's create a notification
            //var notification = new Notification("Bienvenido a FilmsProject");
        } else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {
                // If the user accepts, let's create a notification
                if (permission === "granted") {
                    //var notification = new Notification("Bienvenido a FilmsProject");
                }
            });
        }
    }

    spawnNotification(title) {
        var options = {
            body: title,
            icon: Notification.icon
        }

        var n = new Notification(title, options);
    }
}

var nota = new Notific();