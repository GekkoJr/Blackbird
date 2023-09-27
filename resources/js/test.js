
setTimeout(function () {
    laravelEcho.channel('chat')
    .listen('Message', (e) => {
            console.log(e);
        });
}, 2000)



