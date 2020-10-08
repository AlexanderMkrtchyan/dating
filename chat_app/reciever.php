<?php
/**
 * Template Name: REciever
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socket + PHP</title>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script>
        var socket = io.connect('localhost:3000');
        socket.on('new_order', function(data){
            console.log(data)
        })
    </script>
</body>
</html>