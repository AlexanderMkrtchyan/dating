<?php

/**
 * Template Name: Chat page
 */
get_header();
if (!is_user_logged_in()) {
  ?>

  <div class="container h-100">
    <div class="row align-items-center h-100">
      <div class="col-6 mx-auto">
        <div class="jumbotron" style="text-align: center;">
          Please, login
        </div>
      </div>
    </div>
  </div>
<?php




  exit;
}
?>
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
<div class="new_logged_in"></div>

<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people">
      <div class="inbox_chat">
        <div id="users" class="chat_list active_chat"></div>
        <div id="pagination-container"></div>
      </div>
    </div>
    <div class="mesgs">
      <div class="small_messages">
        <input type="text" class="small_type">
        <div class="small_text"></div>
      </div>
      <div id="small_window">
        <div id="small_windowheader">Click here to move</div>
        <div class="small_chat"></div>
      </div>
      <div class="yellow"></div>
      <div class="type_msg">
        <div class="input_msg_write">
          <textarea readonly type="text" class="write_msg" placeholder="Chat here"></textarea>
          <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
        </div>
      </div>
      <div class="recent">MOST RECENT AT TOP</div>
      <img class="arrow" src="<?php echo get_template_directory_uri() . '/assets/images/arrow.png' ?>" alt="">
      <div class="msg_history"></div>
    </div>
  </div>
</div>

<div class="sql"></div>


<?php

$user_info = get_userdata(get_current_user_id());
$_SESSION['user'] = $user_info->user_login;
$_SESSION['user_id'] = get_current_user_id();
$_SESSION['state'] = get_user_meta( get_current_user_id(), 'state', true );
$_SESSION['country'] = get_user_meta( get_current_user_id(), 'country', true );

$userid = get_current_user_id();
$cur_user_nickname = get_user_meta($userid, 'nickname');

$user_profile_image_id = get_user_meta(get_current_user_id(), 'profile_image')[0];
$user_profile_image =  wp_get_attachment_image_src( $user_profile_image_id,  'thumbnail', true )[0];
?>

<script>


function calcTime(city, offset) {
    var d = new Date();
    var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
    var nd = new Date(utc + (3600000*offset));
    var hours = nd.getHours();
    var minutes = nd.getMinutes();
    return  formatAMPM(nd);
}
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}


function simpleTemplating(response) {
  var html = "";
  for (var i = 0; i < response.length; i++) {
          var z = 0;
          var class_user = '.' + response[i]['user']
          var class_reciever = '.' + response[i]['reciever']
          
          if ($.inArray(response[i]['id'], mesid) == -1) {
            mesid.push(response[i]['id']);
          }
          if (!$('#users').children().hasClass(response[i]['user']) && response[i]['reciever'] == '<?php echo $user_info->user_login ?>') {
            if(response[i]['status'] == 1){
              show = '<i class="fa fa-envelope blinks"></i>'
            }else{
              show = ''
            }
            html += '<div user_id="' + response[i]['user_id'] + '" class="' + response[i]['user'] + '">'+show+'<div class="chat_people"><div class="chat_img"><img class="back_after_click" src="' + response[i]['user_profile_image_thumbnail'] + '" alt="' + response[i]['user'] + '" id="' + response[i]['user_id'] + '"><p class="resp_user">' + response[i]['user_name'] + '</p><a class="clicked_image" href="<?php echo get_site_url() . '/profile/?w1='; ?> ' + response[i]['user_id'] +'" target="_blank"><img class="clicked_image_id"  style="display:none;" src="' + response[i]['user_profile_image_full'] + '" alt="' + response[i]['user'] + '" id="' + response[i]['user_id'] + '"></a><div class="chat_ib"><br><p class="resp_state">' + response[i]['user_city'] + ', ' + response[i]['user_state'] + '</p><p class="reciever_time">(Local time: ' + calcTime(response[i]['user_city'], response[i]['user_time_offset']) + ')</p></div></div></div></div>';
          }
          if (!$('#users').children().hasClass(response[i]['reciever']) && response[i]['user'] == '<?php echo $user_info->user_login ?>') {
            if(response[i]['status'] == 1){
              show = '<i class="fa fa-envelope blinks"></i>'
            }else{
              show = ''
            }
            z++;
            html += '<div user_id="' + response[i]['reciever_id'] + '" class="' + response[i]['reciever'] + '">'+ show +'<div class="chat_people"><div class="chat_img"> <img class="back_after_click" src="' + response[i]['reciever_profile_image_thumbnail'] + '" alt="' + response[i]['reciever'] + '" id="' + response[i]['reciever_id'] + '"><p class="resp_user">' + response[i]['reciever_name'] + '</p><a class="clicked_image" href="<?php echo get_site_url() . '/profile/?w1='; ?> ' + response[i]['reciever_id'] +'" target="_blank"><img class="clicked_image_id"  style="display:none;"  src="' + response[i]['reciever_profile_image_full'] + '" alt="' + response[i]['reciever'] + '" id="' + response[i]['reciever_id'] + '"></a><div class="chat_ib"><br><p class="resp_state">' + response[i]['reciever_city'] + ', ' + response[i]['reciever_state'] + '</p><p class="user_time">(Local time: ' + calcTime(response[i]['reciever_city'], response[i]['reciever_time_offset']) + ')</p></div></div></div></div>'
            
          }
        }

        return  html
}

//////////// MESSAGING AND ACCESING TO USERS  //////////////////
// Displaing users in chat

var chat_history_room_id = '';
var mesid = [];
var x = 0
var back_to_chat = false;
function fuck(){

 

  $('.active_chat').children().on('click', function (e) {

    back_to_chat = false;

            $('.reciever_time').css('display', 'block')
            $('.chat_ib').css('float', 'none')
            $('.chat_ib').css('text-align', 'center')
            $(this).siblings().css('display', 'none')
            $(this).attr('id', 'clicked_user')
            $('.resp_user').addClass('clicked_resp_user')
            $('.yellow').css('display', 'none')
            $('.mesgs').css('padding', '30px 15px 0 25px') 
            $('.arrow').css('display', 'block')
            $('.clicked_image').css('display', 'block')
            $('.clicked_image_id').css('display', 'block')
            $('.back_after_click').css('display', 'none')
            $('#pagination-container').css('display', 'none')
            $(this).find('.fa-envelope').css('display', 'none')
            $('.resp_user').css('position', 'relative')
            $('.resp_state').css('font-size', '23px')
            $('.resp_state').css('margin-bottom', '10px')
            $('.chat_ib').css('display', 'block')
              
              if(!$('#users').siblings().hasClass('back_to_chat')){
              $('#users').parent().append('<button class="back_to_chat">Back to users</button>') 
            }
       
            $('.write_msg').attr('readonly', false)
           
            var clss = $(this).attr('class');
           
            $(this).css('background-color', '#82b4ce');
          
            $(this).siblings().css('background-color', '#e3f1fa')
           
            $('.write_msg').attr('thisclass', clss);
          
            if ($(window).width() < 700) {
              $('.inbox_people').children().css('display', 'none')
              $('.mesgs').css('display', 'block')
              $('.mesgs').css('width', '100%')
              if (!$('.mesgs').children().hasClass('chat_persons'))
                $('.mesgs').prepend('<button class="chat_persons">Back</button>');
            }
            $('.back_to_chat').on('click', function(){
              $('#users').children().fadeIn()
              $('.back_to_chat').remove()
              $('#clicked_user').removeAttr('id')
              $('.resp_user').removeClass('clicked_resp_user')
              $('.reciever_time').css('display', 'none')
              $('.chat_ib').css('float', 'left')
              $('.chat_ib').css('text-align', 'left')
              $('.chat_ib').css('display', 'inline-block')
              $('.yellow').css('display', 'block')
              $('.mesgs').css('padding', '0')
              $('.arrow').css('display', 'none')
              $('.clicked_image').css('display', 'none')
              $('.back_after_click').css('display', 'block')
              $('#pagination-container').css('display', 'block')
              $('.resp_state').css('font-size', '13px')
              $('.resp_state').css('margin-bottom', '0px')
              chat_history_room_id = '';
              back_to_chat = true;
        })
    $('.msg_history').empty()
    who_id_user = '<?php echo get_current_user_id() ?>';
    who_id_reciever = $(this).attr('user_id')
    $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=notification_chat&user_id=' ?>' + who_id_user + '&reciever_id=' + who_id_reciever);
    //geting chat from click event
    $.post({
      url: '<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=get_chat_messages' ?>' + '&user=' + who_id_user + '&reciever=' + who_id_reciever,
      dataType: 'json',
      success: function(response) {
        response.reverse();
        for (var i = 0; i < response.length; i++) {
          chat_history_room_id = response[i]['room_id']
          var z = 0;
          var class_user = '.' + response[i]['user']
          var class_reciever = '.' + response[i]['reciever']
          if (response[i]['user'] == $('.write_msg').attr('thisclass') && response[i]['reciever'] == '<?php echo $user_info->user_login ?>') {
            
            $('.msg_history').prepend('<div class="incoming_msg"><div class="incoming_msg_img"></div><div class="received_msg"><div class="received_withd_msg"><p>' + response[i]['message'] + '</p><span class="time_date">' +  response[i]['date'] + '</span></div></div></div>');
          }
          if (response[i]['user'] == '<?php echo $user_info->user_login ?>' && response[i]['reciever'] == $('.write_msg').attr('thisclass')) {
            $('.msg_history').prepend('<div class="outgoing_msg"><div class="sent_msg"><p>' + response[i]['message'] + '</p><span class="time_date">' + response[i]['date'] + '</span></div></div>');
            $(class_user).html('<div class="chat_people"><div class="chat_img"> <img class="back_after_click" src="' + response[i]['user_profile_image_thumbnail'] + '" alt="' + response[i]['user'] + '" id="' + response[i]['reciever_id'] + '"> <div class="chat_ib"><p class="resp_user">' + response[i]['user'] + '</p><br><p class="resp_state">' + response[i]['user_state'] + ', ' + response[i]['user_city'] + '</p></div></div></div>');
          }
          if ($.inArray(response[i]['id'], mesid) == -1) {
            mesid.push(response[i]['id']);
          }
        }
      },
      error: function(req, status, err) {
        console.log('Something went wrong', status, err);
      }
    });
    
    socket.emit('small room', {'small_room':'small_' + chat_history_room_id, 'room': chat_history_room_id})
    $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=user_room_id&user_id=' ?>' + who_id_user + '&reciever_id=' + who_id_reciever,
        function(response) {
          room_id = JSON.parse(response)[0].room_id
          socket.emit('user room', {'room': room_id})
          $('.back_to_chat').on('click', function(){
            socket.emit('leav_rooms', {'room': room_id, 'user': $('.write_msg').attr('thisclass'), 'to_user': '<?php echo $cur_user_nickname[0]?>'})
          })
      $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=notification_reset&room_id=' ?>' + room_id);

      $(".emojionearea-editor").on('keypress', function(e){
      if(e.which == 13){
        if($(this).text() != ''){
          var user = $('.write_msg').attr('thisclass');
          var from_user = '<?php echo $cur_user_nickname[0];  ?>';
          var message = $(this).text();
          var reciever = $('.write_msg').attr('thisclass');
          // Trying to get normal time//
          function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime
          }
          var date = new Date();
          var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          // console.log(date)
          let usa_date = months[date.getMonth()] + ' ' +  date.getDate() + ', ' + date.getFullYear() + ' ( ' + formatAMPM(date) + ' ) ';
          $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=SendMessageClick&message=' ?>' + message + '&reciever=' + reciever + '&reciever_id=' + who_id_reciever + '&room_id=' + room_id + '&date=' + usa_date);
          $('.write_msg').val('');
          $('.emojionearea-editor').text('');
          socket.emit('small chat message', {'small_room_id': 'small_' + room_id,'room_id': room_id,  'message': message, 'to_user': user, 'from_user': from_user, 'from_user_id': '<?php echo get_current_user_id(); ?>', 'to_user_id': who_id_reciever, 'time': usa_date, 'from_user_image': '<?php echo $user_profile_image ?>'})
        }
      }
    })
        }); 
        
          });


    $('.chat_persons').on('click', function() {
      $('.mesgs').css('display', 'none')
      
    })
  $('.msg_send_btn').on('click', function() {
    var reciever_id = $('.clicked_image_id').attr('id')
    var message = $('.write_msg').val();
    var reciever = $('.write_msg').attr('thisclass');

    if (message != '') {
      $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=SendMessageClick&message=' ?>' + message + '&reciever=' + reciever + '&reciever_id=' + reciever_id,
        function(response) {
          $('.write_msg').val('');
          $('.emojionearea-editor').text('');
        });
    }
  })
}
var global_array = {}
const socket = io('http://localhost:3000');
var socid = socket.id

//  +++++++++++ USERS CONVERSATION VIA SOCKET ++++++++++

var toogler = false;

// SENDING USERS ++++++ NOTIFICATION ++++++++ 


socket.on('notification', function(data){
  console.log(data)  
  console.log('notification')  
  if(!back_to_chat){
    toogler = false;
  }
  if(!$('[user_id=' + data.from_user_id + ']').children().hasClass('fa-envelope')){
  $('[user_id=' + data.from_user_id + ']').append('<i class="fa fa-envelope"></i>')

// Adding users to small chat.

   $('.small_chat').append("<div class='small_rooms' id='" + data.room_id + "' from_user_id=" + data.from_user_id + " to_user_id=" + data.to_user_id + "><img src="+ data.from_user_image +"></div>");
}
    var from_user = data.to_user;
    var from_user_id = data.to_user_id;
    var to_user = data.from_user
    var to_user_id = data.from_user_id
    var room_id = data.room_id

    $(".small_type").on('keypress', function(e){
      
      if(e.which == 13){
        if($(this).val() != ''){
          var message = $(this).val();

          // Trying to get normal time//
          function formatAMPM(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime
          }
          var date = new Date();
          var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          // console.log(date)
          let usa_date = months[date.getMonth()] + ' ' +  date.getDate() + ', ' + date.getFullYear() + ' ( ' + formatAMPM(date) + ' ) ';
          $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=SendMessageClick&message=' ?>' + message + '&reciever=' + from_user + '&reciever_id=' + from_user_id + '&room_id=' + room_id + '&date=' + usa_date);
          socket.emit('small chat message', {'room_id': room_id,'small_room_id':'small_' + room_id,  'message': message, 'to_user': to_user, 'from_user': from_user, 'from_user_id': from_user_id, 'to_user_id': to_user_id, 'time': usa_date, 'from_user_image': '<?php echo $user_profile_image ?>'})

          $('.small_type').val('');
        }
      }
    })


    if(toogler){
    if(data.room_id == chat_history_room_id){
    if(data.from_user != '<?php echo $cur_user_nickname[0] ?>'){
        $('.msg_history').prepend('<div class="incoming_msg"><div class="incoming_msg_img"></div><div class="received_msg"><div class="received_withd_msg"><p>' + data.message + '</p><span class="time_date">'+data.time+'</span></div></div></div>');
        $('.small_text').prepend('<div class="small_reciever">' + data.message + '</div>');
      }else{
        $('.msg_history').prepend('<div class="outgoing_msg"><div class="sent_msg"><p>' + data.message + '</p><span class="time_date">'+data.time+'</span></div></div>');
        $('.small_text').prepend('<div class="small_user">' + data.message + '</div>');
      }
  }else{
    if(data.from_user != '<?php echo $cur_user_nickname[0] ?>'){
        $('.small_text').prepend('<div class="small_reciever">' + data.message + '</div>');
    }else{
        $('.small_text').prepend('<div class="small_user">' + data.message + '</div>');
    }
  }
}
})

 // SENDING MESSAGE TO APPROPRIATE USER ++++++ SMALL MESSAGE +++++++


// Sending message from small chat(at right bottom corner)
socket.on('small message', (data)=>{
    toogler = true;
    console.log(data)
    console.log('small message')

    if(toogler){
      if(data.room_id == chat_history_room_id){
    if(data.from_user != '<?php echo $cur_user_nickname[0] ?>'){
        $('.msg_history').prepend('<div class="incoming_msg"><div class="incoming_msg_img"></div><div class="received_msg"><div class="received_withd_msg"><p>' + data.message + '</p><span class="time_date">'+data.time+'</span></div></div></div>');
        $('.small_text').prepend('<div class="small_reciever">' + data.message + '</div>');
      }else{
        $('.msg_history').prepend('<div class="outgoing_msg"><div class="sent_msg"><p>' + data.message + '</p><span class="time_date">'+data.time+'</span></div></div>');
        $('.small_text').prepend('<div class="small_user">' + data.message + '</div>');
      }
  }else{
    if(data.from_user != '<?php echo $cur_user_nickname[0] ?>'){
        $('.small_text').prepend('<div class="small_user">' + data.message + '</div>');
    }else{
        $('.small_text').prepend('<div class="small_reciever">' + data.message + '</div>');
    }
  }
    }

  
})


// GETTING CONVERSATION FOR SMALL CHAT

$(document).on('click', '.small_rooms', function() {
  $('.small_messages').css('display', 'block')
  let room_id = $(this).attr('id')
  // console.log(room_id) 
  socket.emit('small room', {'room': room_id, 'small_room':'small_' + room_id})
  socket.emit('user room', {'room': room_id})
  $('.small_text').html('')
  let from_user = $(this).attr('from_user_id');
  let to_user = $(this).attr('to_user_id');
  $.post({
      url: '<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=get_chat_messages' ?>' + '&user=' + from_user + '&reciever=' + to_user,
      dataType: 'json',
      success: function(response) {
        // console.log(response)
        response.reverse();
        for (var i = 0; i < response.length; i++) {
          if(response[i]['user_id'] == from_user){
            $('.small_text').prepend('<div class="small_reciever">' + response[i]['message'] + '</div>');
          }else{
            $('.small_text').prepend('<div class="small_user">' + response[i]['message'] + '</div>');
          }
        }
      },
      error: function(req, status, err) {
        console.log('Something went wrong', status, err);
      }
    });


});


socket.emit('chat page', {"user": '<?php echo $cur_user_nickname[0] ?>', 'user_id': '<?php echo get_current_user_id(); ?>', 'user_image': '<?php echo $user_profile_image ?>,'})
socket.on('new connected user', function(data){

  $('.new_logged_in').html('<div class="user_name"><div class="user_who">' + data.user + '</div><img style="border-radius: 10px;" src="'+ data.user_image + '"><p class="just"> just logged in</p></div>')
  $('.new_logged_in').delay(4000).fadeOut()
  //console.log(data)
})



socket.on('times and cities', function(data){
    global_array = JSON.stringify(data)
})




</script>
<?php
get_footer();
