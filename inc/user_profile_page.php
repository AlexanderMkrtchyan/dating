<?php
/* Template Name: User Profile */


get_header();


if (isset($_GET["w1"])) {
    $user_ID = $_GET["w1"];
    $userdata = get_user_by('id', $user_ID);
}else {
    $user_ID = get_current_user_id();
    $_GET['w1'] = get_current_user_id();
    $userdata = get_user_by('id', $user_ID);   

}



?>

<section class="profile_underheader" >
    <h1 class="animated7 text-white"><?php echo get_user_meta($user_ID, 'nickname')[0] . '\'s profile'; ?></h1>
    <div class="profile_image">
        <img class="img-fluidd img-fluid w-100" src="<?php echo wp_get_attachment_image_src( get_user_meta($user_ID,'profile_image')[0], 'thumbnail',true )[0]; ?>" alt="Profile Image" />

   
</div>
</section>


</head>


<section class="profile_images">
    <div class="container">

        <!-- Trigger/Open The Modal -->
        <?php if (get_current_user_id() != $user_ID) {  ?>
            <button class="view_notification button btn-lg btn-theme full-rounded animated right-icn" id="myBtn">Message Me</button>
        
        <!-- The Modal -->
        <div id="myModal" class="modal-message">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="mesgs">

                        <div class="type_msg">
                            <div class="input_msg_write">
                                <textarea type="text" id_attr="<?php echo get_user_meta($user_ID, 'nickname')[0]; ?>" reciever_id="<?php echo $user_ID; ?>" class="write_message_profile" placeholder="Type a message"></textarea>
                                <button class="msg_send_btn send_button_profile" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div class="msg_history"></div>
                    </div>
                </div>
            </div>

            <div class="messageid"></div>
            <!-- Modal content -->
            <div class="close">x</div>
        </div>


        <?php
        $user_info = get_userdata(get_current_user_id());
        $_SESSION['reciever'] = get_user_meta($user_ID, 'nickname')[0];
        $_SESSION['user'] = get_user_meta(get_current_user_id(), 'nickname')[0];
        $_SESSION['user_id'] = get_current_user_id();
       // $_SESSION['reciever_id'] = $user_ID;
        


        $userid = get_current_user_id();
        $cur_user_nickname = get_user_meta($userid, 'nickname');
        ?>
        <script>

            $(document).ready(function() {
                loadChat();
            });
            $('.view_notification').on('click', function() {
                $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=notification' ?>', function(response) {});
            });



            $('.write_msg').keyup(function(e) {
                $('.write_msg').css('background', 'none 0px 0px repeat scroll rgb(255, 122, 27)')
                $('.write_msg').css('color', 'white')
                var message = $(this).val();
                if (message.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi) || message.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/) || message.match(/(https?:\/\/)?(www.facebook.com\/).([a-z.]{2,6})([/w.-]*)*/igm) || message.match(/(https?:\/\/)?(www.instagram.com\/).([a-z.]{2,6})([/w.-]*)*/igm)) {

                    $('.write_msg').val('Our Privacy Policy do not allow you to send email, phone number or any social account');
                    $('.write_msg').css('background-color', 'red')
                    $('.write_msg').css('color', 'black')
                    $('.write_msg').css('font-size', '20px')
                    $('.write_msg').attr('readonly', true)
                    setTimeout("$('.write_msg').attr('readonly', false)", 4000);
                    setTimeout("$('.write_msg').val('')", 4000);
                    setTimeout("$('.write_msg').css('font-size', '20px')", 4000);
                    setTimeout("$('.write_msg').css('background-color', 'transparent')", 4000);

                }
                var reciever_id = '<?php echo $user_ID; ?>';
                var reciever = '<?php echo get_user_meta($user_ID, 'nickname')[0]; ?>';
      
            });
            $('.msg_send_btn').on('click', function() {
                var message = $('.write_message_profile').val();
                var reciever = '<?php echo get_user_meta($user_ID, 'nickname')[0]; ?>';
                var reciever_id = '<?php echo $user_ID; ?>'
                var from_user = '<?php echo get_current_user_id(); ?>'
                if (message != '') {

                    function makeid(length) {
                            var result           = '';
                            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            var charactersLength = characters.length;
                            for ( var i = 0; i < length; i++ ) {
                                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                            }
                            return result;
                            }

                    $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=SendMessageFromProfile&message=' ?>' + message + '&reciever=' + reciever + '&reciever_id=' + reciever_id + '&room_id=' + makeid(30),
                        function(response) {
                            loadChat();
                            $('.write_message_profile').val('');
                            $('.emojionearea-editor').text('');
                        });


                        
                        
                        
                    
                       //$.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=send_to_room&user=' ?>' + from_user + '&reciever=' + reciever_id + '&room_id=' + makeid(30));
                }
            })

            var mesid = [];
            var message_count = [];

            function loadChat() {

                $.ajax({
                    url: '<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=getChat' ?>',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                //console.log(response[0]['user']);
                $.each(response, function() {
                    for (var i = 0; i < response.length; i++) {
                       // console.log(response[i])
                        if ($.inArray(response[i]['id'], mesid) == -1) {
                            mesid.push(response[i]['id']);
                            if (response[i]['user'] == '<?php echo get_user_meta($user_ID, 'nickname')[0] ?>' && response[i]['reciever'] == '<?php echo $user_info->user_login ?>') {
                                $('.msg_history').prepend('<div class="incoming_msg"><div class="incoming_msg_img">  </div><div class="received_msg"><div class="received_withd_msg"><p>' + response[i]['message'] + '</p><span class="time_date">' + response[i]['date'] + '</span></div></div></div>');
                            }
                            if (response[i]['user'] == '<?php echo $user_info->user_login  ?>' && response[i]['reciever'] == '<?php echo get_user_meta($user_ID, 'nickname')[0] ?>') {
                                $('.msg_history').prepend('<div class="outgoing_msg"><div class="sent_msg"><p>' + response[i]['message'] + '</p><span class="time_date">' + response[i]['date'] + '</span></div></div>');
                            }
                            if ($.inArray(response[i]['reciever'], message_count) == -1 && response[i]['reciever'] != '<?php echo get_user_meta(get_current_user_id(), 'nickname')[0] ?>' && response[i]['user'] == '<?php echo get_user_meta(get_current_user_id(), 'nickname')[0] ?>') {
                                message_count.push(response[i]['reciever']);
                            }
                            if (response[i]['reciever'] == '<?php echo get_user_meta(get_current_user_id(), 'nickname')[0] ?>' && response[i]['status'] == 1) {
                                // $('.my_girls').text('You have nes message')
                                if (!$('.my_girls').children().hasClass('bell')) {
                                    $('.my_girls').append('<span class="bell fa fa-bell"></span>')
                                }
                            } else {
                                $('.bell').remove()
                            }
                        }
                    }
                });
            },
            error: function(req, status, err) {
                console.log('Something went wrong', status, err);
            }
        });

                if (message_count.length > 3) {
                    if ('<?php echo pmpro_hasMembershipLevel('Gold') ?>' == false && '<?php echo pmpro_hasMembershipLevel('Private') ?>' == false && '<?php echo  pmpro_hasMembershipLevel('Trial') ?>' == false) {
                        if ($.inArray('<?php echo get_user_meta($user_ID, 'nickname')[0]; ?>', message_count) == -1) {
                            $('#myModal').html('<div class="reached_limit"><a class="text_limit" href="<?php echo get_site_url(null, '/membership-account/membership-levels/', null) ?>">You have reached the limit of free account. Click me to become a member</a></div>');
                        }
                    }
                }
               // console.log(message_count)
            }
            setInterval(function() {
                loadChat();
            }, 2000);

    // Get the modal
    var modal = document.getElementById("myModal");

    // When the user clicks the button, open the modal
    $('#myBtn').on('click', function() {
        modal.style.display = "block";
    })
    // When the user clicks on <span> (x), close the modal
    $('.close').on('click', function() {
        modal.style.display = "none";
    })

    // When the user clicks anywhere outside of the modal, close it
    $(window).on('click', function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    })
</script> 
<?php } ?>
  <table class="form-table">


      <?php echo display_images_from_media_library(); ?>
      <!-- Uploading image to site -->
  </table>
</div>
</section>
<section class="profile_appr">
  <?php if ($userdata->about_me != '') : ?>
      <div class="container">
          <div class="row profile_border">
              <p class="prof_sect">About <?php echo get_user_meta($user_ID, 'nickname')[0] . ':'; ?></p>
              <p class="pro_text"><?php echo $userdata->about_me ?></p>
          </div>
      </div>
  <?php endif; ?>
  <?php if ($userdata->looking_for_in != '') : ?>
  <div class="container ">
      <div class="row profile_border">
          <p class="prof_sect"><?php echo get_user_meta($user_ID, 'nickname')[0] . '\'s'; ?> Looking for?</p>

          <p class="pro_text"><?php echo $userdata->looking_for_in ?></p>

      </div>
  </div>
<?php endif; ?>
  <?php if (get_user_meta($user_ID, 'country')[0] != '' || get_user_meta($user_ID, 'relationship')[0] != '' || get_user_meta($user_ID, 'user_tatoo')[0] != '' || get_user_meta($user_ID, 'education')[0] != '' || get_user_meta($user_ID, 'drinking')[0] != '' || get_user_meta($user_ID, 'income')[0] != '' ||  get_user_meta($user_ID, 'piercings')[0] != '') : ?>
  <div class="container">
      <div class="row profile_border">
          <p class="prof_sect">Lifestyle</p>
          <div class="flex-profile-container ">

              <?php if (get_user_meta($user_ID, 'relationship')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="relationship">
                      <p class="user_profile_info">Status:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'relationship')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'looking_for')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="looking_for">
                      <p class="user_profile_info">Relationship:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'looking_for')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'user_tatoo')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="user_tatoo">
                      <p class="user_profile_info">Tattoo:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'user_tatoo')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'education')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="education">
                      <p class="user_profile_info">Education:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'education')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'drinking')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="drinking">
                      <p class="user_profile_info">Drinking:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'drinking')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'smoking')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="smoking">
                      <p class="user_profile_info">Smoking:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'smoking')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>
              <?php if (get_user_meta($user_ID, 'income')[0] != '') : ?>
                  <div class="flex-profile-div">
                      <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="income">
                      <p class="user_profile_info">Income:<br \>
                          <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'income')[0]; ?></p>
                      </p>
                  </div>
              <?php endif; ?>

          </div>
      </div>

  </div>
<?php endif; ?>


<?php if (get_user_meta($user_ID, 'state')[0] != '' || get_user_meta($user_ID, 'country')[0] != '') : ?>
<div class="container">
    <div class="row profile_border">
        <p class="prof_sect">WYA?</p>
        <div class="flex-profile-container">
            <?php if (get_user_meta($user_ID, 'state')[0] != '') : ?>
           
                <div class="flex-profile-div">
               
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="State">
                    <p class="user_profile_info">State:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'state')[0]; ?></p>
                    </p>
               
                </div>
            <?php endif; ?>
            <?php if (get_user_meta($user_ID, 'city')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="City">
                    <p class="user_profile_info">City:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'city')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>
            </div>
        </div>

    </div>
<?php endif; ?>

<?php if (get_user_meta($user_ID, 'puc')[0] != '' || get_user_meta($user_ID, 'size')[0] != '' || get_user_meta($user_ID, 'eye_color')[0] != '' || get_user_meta($user_ID, 'age')[0] != '' || get_user_meta($user_ID, 'hair_color')[0] != '') : ?>
<div class="container">
    <div class="row profile_border">
        <p class="prof_sect">...and Physically?</p>
        <div class="flex-profile-container">

            <?php if (get_user_meta($user_ID, 'puc')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="Height">
                    <p class="user_profile_info">Piercings:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'piercings')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (get_user_meta($user_ID, 'size')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="size">
                    <p class="user_profile_info">Body type:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'size')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (get_user_meta($user_ID, 'eye_color')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="eye_color">
                    <p class="user_profile_info">Eye color:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'eye_color')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (get_user_meta($user_ID, 'age')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="age">
                    <p class="user_profile_info">Age:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'age')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (get_user_meta($user_ID, 'hair_color')[0] != '') : ?>
                <div class="flex-profile-div">
                    <img class="user_profile_image_info" src="<?php echo get_template_directory_uri() . '/assets/images/user_profile/about_me.png' ?>" alt="hair_color">
                    <p class="user_profile_info">Hair color:<br \>
                        <p class="user_inline_info acss animated fadeInRight"><?php echo get_user_meta($user_ID, 'hair_color')[0]; ?></p>
                    </p>
                </div>
            <?php endif; ?>


        </div>
        <hr class="user_change_hr">
    </div>
</div>
<?php endif; ?>

</section>
<?php

// $girl_users = get_users( array( 'fields' => array( 'ID' ), 'meta_key'=> 'gender', 'meta_value'=> 'Male') );
// foreach($girl_users as $girl_id){
//     $user_id = $girl_id->ID;
//     geting_some_shit($user_id);
// }
// function geting_some_shit($user_id)
// {
//     $args = array(
//         'post_type' => 'attachment',
//         'post_mime_type' => array('image/jpeg', 'image/png', 'video/mp4'),
//         'post_status' => 'inherit',
//         'posts_per_page' => -1,
//         'author' => $user_id,
//         'orderby' => 'title'
//     );
//     $query_images = new WP_Query($args);
//     $images = array();
//     foreach ($query_images->posts as $image) {
        
//         $images[] = $image->ID;
//     }
//     // var_dump($images);
//     update_user_meta( $user_id, 'profile_image', $images[1] );
   
// }

function get_images_from_media_library()
{
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => array('image/jpeg', 'image/png', 'video/mp4'),
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        'author' => $_GET["w1"],
        'orderby' => 'title'
    );
    $query_images = new WP_Query($args);
    $images = array();
    foreach ($query_images->posts as $image) {
        $images[] = $image->ID;
    }
    // var_dump($images);
    return $images;
}

function display_images_from_media_library()
{

    $imgs = get_images_from_media_library();
    $html = '<div class="container"><div class="row">';
    $html .=  '<div class="col-md-12 col-xs-12">';
    $html .= '<div style="display:none;" class="html5gallery" data-skin="horizontal" data-width="843" data-height="480">';
    $vid = 0;
    foreach ($imgs as $video) {
        
        if (get_post_mime_type($video) == 'video/mp4' && $video != 793) {
            $url = wp_get_attachment_url($video);
            if (carbon_get_post_meta($video, 'private_video') == '') {
                $html .= '<a href="' . $url . '"><img src="' . get_site_url() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
            }
            $vid++;
        }
    }
    if ($vid == 0) {
        $url = wp_get_attachment_url(718);
        $html .= '<a href="' . $url . '"><img src="' . get_template_directory_uri() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
    }
    $html .= '</div>';
    $html .= '</div>';





    //Image section

    $html .= '<div class="col-md-12 col-xs-12">';
    //echo wp_get_attachment_image_src($imgs[0]);
    $html .= '<div id="profile_carousel"  carousel-row class="owl-carousel" data-nav-arrow="false" data-items="4" data-lg-items="4" data-md-items="3" data-sm-items="2" data-space="0">';

    foreach ($imgs as $img) {
        if (carbon_get_post_meta($img, 'privat_image') != 'private') {
            $src_thumb = wp_get_attachment_image_src($img);
            $src_full = wp_get_attachment_image_src($img, 'full');
            if (get_post_mime_type($img) == 'image/jpeg') {
                $html .= '
                <div class="item-wrap">
                <div class="item">
                <div  class="profile-image clearfix">
                <a class="example-image-link" href="' . $src_full[0] . '" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                <img class="example-image" src="' . $src_thumb[0] . '" alt=""/></a>
                </div>
                </div>
                </div>';
            }
        } 
    }
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div></div>';
    $html .= '<div class="container"><div class="flex_links profile_flex_links"><div  class="priv_image_link profile_private_links"><img class="private_link_images" src="' . get_template_directory_uri(  ) . '/assets/images/timeline/old_camera.png" alt="old camera"/>Private Photo Gallery</div><div  class="priv_video_link profile_private_links"><img class="private_link_images" src="' . get_template_directory_uri(  ) . '/assets/images/timeline/film_canister.png" alt="old cinema"/>Private Video Arcade</div></div></div>';

    // Displaing private image collection

    $html .= '<div class="container"><div class="row">';
    $html .= '<div class="col-md-12 col-xs-12">';
    //echo wp_get_attachment_image_src($imgs[0]);
    $html .= '<div id="profile_carousel"  carousel-row class="owl-carousel" data-nav-arrow="false" data-items="4" data-lg-items="4" data-md-items="3" data-sm-items="2" data-space="0">';

    foreach ($imgs as $img) {


        if (carbon_get_post_meta($img, 'privat_image') == 'private' && $_GET['w1'] == get_current_user_id() || pmpro_hasMembershipLevel('Private') && $_GET['w1'] != get_current_user_id()) {
            $src_thumb = wp_get_attachment_image_src($img);
            
            $src_full = wp_get_attachment_image_src($img, 'full');
            if (get_post_mime_type($img) == 'image/jpeg') {
                $html .= '
                <div class="item private_imgs_click" >
                <div class="profile-image clearfix">
                <a class="example-image-link" href="' . $src_full[0] . '" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                <img class="example-image" src="' . $src_thumb[0] . '" alt=""/></a>
                </div>
                </div>';
            }
        } 
        if (carbon_get_post_meta($img, 'privat_image') == 'private' && !pmpro_hasMembershipLevel('Private') && $_GET['w1'] != get_current_user_id()) {
            $src_thumb = wp_get_attachment_image_src($img);
            $src_full = wp_get_attachment_image_src($img, 'full');
            if (get_post_mime_type($img) == 'image/jpeg') {
                $html .= '
                <div class="item">
                <div class="profile-image clearfix">
                <a class="example-image-link" href="' . get_site_url(null, '/membership-account/membership-levels/', null) . '"  data-title="Click the right half of the image to move forward.">
                <img class="example-image" src="' . get_template_directory_uri() . '/assets/images/members_only.png' . '" alt=""/></a>
                </div>
                </div>';
            }
        }
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div></div>';
    $html .= '</div></div>';

    //Displaing video collection

    $html .= '<div class="container"><div class="row">';
    $html .= '<div class="col-md-12 col-xs-12 private_video_coll">';


    $html .= '<div style="display:none;" class="html5gallery " data-skin="horizontal" data-width="843" data-height="272">';
    $vid = 0;
    foreach ($imgs as $video) {
        if (get_post_mime_type($video) == 'video/mp4' && $imgs != 718) {
            $url = wp_get_attachment_url($video);
            if (!pmpro_hasMembershipLevel('Private') && carbon_get_post_meta($video, 'private_video') != '') {
                $priv = wp_get_attachment_url(793);
                $html .= '<a href="' . $priv . '"><img src="' . get_template_directory_uri() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
            } elseif (pmpro_hasMembershipLevel('Private') && carbon_get_post_meta($video, 'private_video') != '') {
                $html .= '<a href="' . $url . '"><img src="' . get_template_directory_uri() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
            }
            $vid++;
        }
        if(carbon_get_post_meta($video, 'private_video') == 'private_vd' && $_GET['w1'] == get_current_user_id() && get_post_mime_type($video) == 'video/mp4'){
            $url = wp_get_attachment_url($video);
            $html .= '<a href="' . $url . '"><img src="' . get_template_directory_uri() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
        }

    }
    if ($vid == 0) {
        $url = wp_get_attachment_url(793);
        
    }
    $html .= '</div>';



    $html .= '</div></div></div>';



    return $html;
}



if (get_current_user_id() == $user_ID) {
    ?>
    <div class="form-group sm-mb-0" style="display: flex;justify-content: center;"><a href=" <?php echo get_permalink(get_page_by_path('change-profile')); ?>"><button class="button btn-lg btn-theme full-rounded animated right-icn">Change</button></a></div>
    <?php
}


if (get_current_user_id() == $user_ID) {
    echo do_shortcode('[pmpro_account sections="membership,profile,invoices,links"]');
}
?>

<?php

get_footer();
