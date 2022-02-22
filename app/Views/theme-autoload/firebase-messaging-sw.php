<?php header('Content-Type: application/javascript'); ?>

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
var firebaseConfig = {
apiKey: '<?= config('firebase')->apiKey; ?>',
authDomain: '<?= config('firebase')->authDomain; ?>',
databaseURL: "https://fcm-XXXXXXXXXXXX.firebaseio.com",
projectId: '<?= config('firebase')->projectId; ?>',
storageBucket: '<?= config('firebase')->storageBucket; ?>',
messagingSenderId: '<?= config('firebase')->messagingSenderId; ?>',
appId: '<?= config('firebase')->appId; ?>',
measurementId: '<?= config('firebase')->measurementId; ?>'
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
console.log(payload);
const notification=JSON.parse(payload);
const notificationOption={
body:notification.body,
icon:notification.icon
};
return self.registration.showNotification(payload.notification.title,notificationOption);
});

