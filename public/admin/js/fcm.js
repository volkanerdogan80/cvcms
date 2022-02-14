function FirebaseNotification() {
    this.local_token = localStorage.getItem("fcmToken");
    this.getToken();
}

FirebaseNotification.prototype.getToken = function (){
    messaging.requestPermission().then(function () {
        return messaging.getToken()
    }).then((token) => this.tokenControl(token)).catch(function (err) {
        console.log("Notify", err);
    });
}

FirebaseNotification.prototype.tokenControl = function (token){
    if(!this.local_token && this.local_token != token){
        this.setDBToken(token);
        localStorage.setItem("fcmToken", token);
    }
}

FirebaseNotification.prototype.setDBToken = function (token){
    cveThemeRequest(routes.firebase_token, {token: token}, function (){}, false);
}

messaging.onMessage(function (payload) {
    const notificationOption={
        body:payload.notification.body,
        icon:payload.notification.icon
    };

    if(Notification.permission==="granted"){
        var notification=new Notification(payload.notification.title,notificationOption);

        notification.onclick=function (ev) {
            ev.preventDefault();
            window.open(payload.notification.click_action,'_blank');
            notification.close();
        }
    }
});

let FCM = new FirebaseNotification();

