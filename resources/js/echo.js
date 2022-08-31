import Echo from "laravel-echo";

// import io from 'socket.io/node_modules/socket.io-client';

window.io = require("socket.io-client");

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: "http://localhost:6001",
    // host: window.location.hostname + ':6001',
    // transports: ["websocket","polling", "flashsocket"],
});
