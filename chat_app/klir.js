var socket = require('socket.io'),
    http = require('http'),
    https = require('https'),
    express = require('express');
    const request = require('request');
    
var app = express();
var http_server = http.createServer(app).listen(3000, function(){console.log('connected to server')}) 
var user_conversation;

var connected_users = []






let result_array = []



function emitNewOrder(http_server){
    var io = socket.listen(http_server)
    
    
    
    io.sockets.on('connection', function(socket){



      socket.on('user cities', function(data){
        let cities = data['cities'];
        for(var i = 0; i<cities.length; i++){

          

          var d = new Date()
          let boz = cities[i].city
          let bozi_axchik = cities[i].id
          
          request('https://api.teleport.org/api/cities/?search=' + boz +'&embed=city:search-results/city:item/city:timezone/tz:offsets-now', function(err, res, body) {
            try {
              let klir = JSON.parse(body);
              let time_offset = klir._embedded['city:search-results'][0]._embedded['city:item']._embedded['city:timezone']._embedded['tz:offsets-now']['total_offset_min']/60;
              result_array.push({'id':bozi_axchik,'city': boz,time_offset})
                

              socket.emit('times and cities', result_array)
              
              
            } catch (error) {
              console.log('seems this shit live in ass hole')
            }
          });
        }
        
      })

      socket.on('chat page', function(data){
        if(!connected_users.includes(data.user_id)){
          connected_users.push(data.user_id)
        }
        socket.join(data.user_id)
        socket.broadcast.emit('new connected user',{'user': data.user, 'user_id': data.user_id, 'user_image': data.user_image})
      })
      socket.on('user room', function(room){
       socket.join(room.room);
      })
      socket.on('small room', function(data){
        socket.join(data.room);
        socket.join(data.small_room);

      })

      socket.on('small chat message', (data)=>{
        console.log(data)
        io.to(data.room_id).emit('small message', data)
        io.to(data.to_user_id).emit('notification', data) 
      })
      
      socket.on('leav_rooms', function(room_leave){

        io.to(room_leave.room).emit('message', {'message': room_leave.to_user + ' left the chat'})
        socket.leave(room_leave.room)
      })

    io.emit('sql users', user_conversation)

    })
    
}


emitNewOrder(http_server);

