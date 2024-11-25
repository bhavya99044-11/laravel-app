

window.Pusher = Pusher;

import Echo from 'laravel-echo';
 import Pusher from 'pusher-js';

 const echo = new Echo({
 broadcaster: 'pusher',
 key: '0519053939aefd09aa7d',
 cluster: 'ap2',
 forceTLS: true,
 auth: {
 headers: {
 Authorization: 'Bearer ' + token
 }
 },
 namespace: 'App.Events',
 encrypted: true,
 });

