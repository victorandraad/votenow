import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// import Echo from "laravel-echo";
// import Pusher from "pusher-js";

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "633a0c8b47f2ea10328a", // use a chave do Pusher
//     cluster: "us2", // use o cluster do Pusher
//     forceTLS: true,
// });

// document.addEventListener('DOMContentLoaded', function() {
//     window.Echo.channel("chat").listen("MensagemEnviada", (e) => {
//         console.error(e.mensagem); // Exibe a mensagem no console
//     });
// });

import Pusher from 'pusher-js';

document.addEventListener('DOMContentLoaded', function() {
    const pusher = new Pusher('633a0c8b47f2ea10328a', {
        cluster: 'us2',
    });

    const channel = pusher.subscribe('chat');
    channel.bind('MensagemEnviada', function(data) {
        console.log('Recebido:', data);
        channel.trigger('evento', { mensagem: 'Seu texto aqui' });
    });
});


