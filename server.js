const io = require('socket.io')(6001);

// const io = require('socket.io')(6001, {
//     origins: 'http://127.0.0.1:8000/:*'
// });

const Redis = require('ioredis');
const redis = new Redis;
const request = require('request');

// io.use(function (socket, next)
// {
//     request.get({
//         url: 'http://127.0.0.1:8000/',
//         headers: { cookie: socket.request.headers.cookie },
//         json: true
//     }, function (error, response, json){
//         console.log(json)
//     })
//
//     next( new Error('Auth Error') )
//
// })

redis.psubscribe('*', function (error, count)
{
    //
})

redis.on('pmessage', function (patter, channel, message)
{
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data)

    console.log(channel)
    console.log(message.event)
    console.log(message.data)

})
