/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/10.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/10.2.0/firebase-analytics.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyAoeRWLOlNcnTBRzSQpnITUgcIlsDx_IsM",
    authDomain: "laravel-push-notification-pr.firebaseapp.com",
    projectId: "laravel-push-notification-pr",
    storageBucket: "laravel-push-notification-pr.appspot.com",
    messagingSenderId: "797112868438",
    appId: "1:797112868438:web:84398ac056565e91d3a5f7",
    measurementId: "G-V9H76LYE4J"
    });
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});