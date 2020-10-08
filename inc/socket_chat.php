<?php
/**
 * Template Name: Socket Chat Template
 */
get_header();
?>

<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font: 13px Helvetica, Arial;
        }

        form {
            background: #000;
            padding: 3px;
            position: fixed;
            bottom:64px;
            width: 60%;
        }

        form input {
            border: 0;
            padding: 10px;
            width: 90%;
            margin-right: .5%;
        }

        form button {
            width: 9%;
            background: rgb(130, 224, 255);
            border: none;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messages li {
            padding: 5px 10px;
        }

        #messages li:nth-child(odd) {
            background: #eee;
        }

        .typing {
            display: none;
        }

        .klir {
            height: 100%;
            width: 100%;
            position: absolute;
            z-index: 100;
            background-color: aqua;
            top: 0;
        }

        .name_input {
            width: auto;
        }

        .online_users {
            width: 40%;
            float: right;
            cursor: pointer;
            font-size: medium;
            border: 1px solid;
            text-align: center;
        }
    </style>
 <div class="name_submit">
            <form action="" class="klir">
                <label for="name_input">Type your name please</label>
                <input type="text" class="name_input"><button class="puc">Send</button>
            </form>
        </div>
        <div class="users_interation">
            <ul id="messages"></ul>
            <ul class="typing"></ul>
            <form action="">
                <input id="m" autocomplete="off" /><button>Send</button>
            </form>
        </div>
        <div class="online_users"></div>
        <script>
            $('form').on('submit', function(){
                var message = $('#m').val();
                $.post('<?php echo get_template_directory_uri() . '/chat_app/emit_test.php?action=get_data&message=' ?>' + message);
            })

            $(function () {
                var socket = io.connect('localhost:3000');

                socket.on("new_msg", function(data) {
                    alert(data.msg);
                    //$('#messages').append($('<li>').text(msg));
                    })
                $('form').submit(function (e) {
                    e.preventDefault(); // prevents page reloading
                    socket.emit('chat message', $('#m').val());
                    
                    $('#m').val('');

                    return false;
                });
                $('.klir').submit(function (e) {
                    e.preventDefault();
                    socket.emit('user name', $('.name_input').val());
                    $('.name_submit').css('display', 'none')
                    $('.typing').css('display', 'none')
                })

                socket.on('user name', function (e) {
                   console.log(e)
                //    for(var i = 0; i < e.length; i++){
                //        console.log(e[i])
                //    }
                    $.each(e, function (key, value) {
                       //$('.online_users').append('<div>' + value.name + '</div>')
                        console.log( 'name:' +  value.name  + '  socket id:' + value.sid )

                    });
                    
                })

                socket.on('chat message', function (msg) {
                    $('#messages').append($('<li>').text(msg));
                });
                socket.on('typing', function (nm) {
                    //console.log(nm)
                    $('.typing').html(nm + ' is typing now')
                })

                var searchTimeout;
                $('#m').on('keypress', function () {
                    if (searchTimeout != undefined) clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(callServerScript, 250);
                });
                function callServerScript() {
                    // your code here
                    socket.emit('typing', $('.name_input').val())
                }
            });
        </script>
<?php
get_footer();