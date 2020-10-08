var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '../socket_chat.php');
  });

http.listen(3000, function(){
  console.log('listening on */socket');
});

io.on('connection', function(socket){
    console.log('a user connected');
  });
  
  http.listen(socket, function(){
    console.log('whats up mathafucka?');
  });