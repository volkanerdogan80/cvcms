<?php if(config('firebase')->status): ?>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: '<?= config('firebase')->apiKey; ?>',
            authDomain: '<?= config('firebase')->authDomain; ?>',
            projectId: '<?= config('firebase')->projectId; ?>',
            storageBucket: '<?= config('firebase')->storageBucket; ?>',
            messagingSenderId: '<?= config('firebase')->messagingSenderId; ?>',
            appId: '<?= config('firebase')->appId; ?>',
            measurementId: '<?= config('firebase')->measurementId; ?>',
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
    </script>
    <script src="<?= base_url('public/admin/js/fcm.js') ?>"></script>
<?php endif; ?>
