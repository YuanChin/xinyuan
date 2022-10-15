import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

 import Echo from 'laravel-echo';

 import Pusher from 'pusher-js';
 window.Pusher = Pusher;
 
 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: import.meta.env.VITE_PUSHER_APP_KEY,
     wsHost: window.location.hostname,
     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
     forceTLS: false,
     enabledTransports: ['ws', 'wss'],
 });

import Swal from "sweetalert2";
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

let token  = document.head.querySelector('meta[name=csrf-token]').content;
window.token = token;

let userId = document.head.querySelector('meta[name=user-id]').content;
window.userId = userId;

window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
    window.dispatchEvent(new CustomEvent("set-notification-count", {
        detail: {count: notification.notification_count}
    }));
});