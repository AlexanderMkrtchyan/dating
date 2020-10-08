<?php
function dating_scripts()
{
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', false, null, false);
    wp_enqueue_style('dating-style', get_stylesheet_uri(), false, null, 'all');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', false, null, 'all');
    wp_enqueue_style('bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css', false, null, 'all');
    wp_enqueue_style('bootstrap-slider', get_template_directory_uri() . '/assets/css/bootstrap-slider.min.css', false, null, 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), null, 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null, 'all');
    wp_enqueue_style('general', get_template_directory_uri() . '/assets/css/general.css', array(), null, 'all');
    wp_enqueue_style('magnific', get_template_directory_uri() . '/assets/css/magnific-popup/magnific-popup.css', array(), null, 'all');
    wp_enqueue_style('mega_menu', get_template_directory_uri() . '/assets/css/mega-menu/mega_menu.css', array(), null, 'all');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel/owl.carousel.css', array(), null, 'all');
    wp_enqueue_style('skin-default', get_template_directory_uri() . '/assets/css/skins/skin-default.css', array(), null, 'all');
    wp_enqueue_style('lightbox', get_template_directory_uri() . '/assets/css/lightbox.css', array(), null, 'all');
    wp_enqueue_style('teleport', get_template_directory_uri() . '/assets/css/teleport-autocomplete.css', array(), null, 'all');



    wp_enqueue_style('emojionearea', get_template_directory_uri() . '/assets/css/emojionearea.min.css', array(), null, 'all');
    wp_enqueue_style('modal_css',get_template_directory_uri() . '/assets/css/jquery.modal.min.css', array(), null, 'all');

    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/Flaticon.eot', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/Flaticon.eot_', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/Flaticon.svg', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/Flaticon.ttf', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/Flaticon.woff', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.eot', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.eot_', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.svg', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.ttf', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.woff', false, null, 'all');
    wp_enqueue_style('Flaticon', get_template_directory_uri() . '/assets/fonts/fontawesome-webfont.woff2', false, null, 'all');


    wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', array('jquery'), null, false);
    wp_enqueue_script('bootstrap-slider', get_template_directory_uri() . '/assets/js/bootstrap-slider.min.js', array('jquery'), null, false);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, false);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl-carousel/owl.carousel.min.js', array('jquery'), null, false);
   
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, false);
    //wp_enqueue_script('appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array('jquery'), null, false);
    
    //wp_enqueue_script('text-rotator', get_template_directory_uri() . '/assets/js/jquery.simple-text-rotator.js', array('jquery'), null, false);
    //wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), null, false);
    //wp_enqueue_script('style-customizer', get_template_directory_uri() . '/assets/js/style-customizer.js', array('jquery'), null, false);
    //wp_enqueue_script('downCount', get_template_directory_uri() . '/assets/js/countdown/jquery.downCount.js', array('jquery'), null, false);
    //wp_enqueue_script('countTo', get_template_directory_uri() . '/assets/js/counter/jquery.countTo.js', array('jquery'), null, false);
    //wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/js/isotope/isotope.pkgd.min.js', array('jquery'), null, false);
    //wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, false);
    wp_enqueue_script('mega-menu', get_template_directory_uri() . '/assets/js/mega-menu/mega_menu.js', array('jquery'), null, false);
    // wp_enqueue_script('jqbar', get_template_directory_uri() . '/assets/js/skills-graph/jqbar.js', array('jquery'), null, false);
   wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), null, false);
    //wp_enqueue_script('html5gallery', get_template_directory_uri() . '/assets/js/html5gallery.js', array('jquery'), null, false);
    //wp_enqueue_script('geocomplete', get_template_directory_uri() . '/assets/js/jquery.geocomplete.js', array('jquery'), null, false);
    wp_enqueue_script('teleport-autocomplete', get_template_directory_uri() . '/assets/js/teleport-autocomplete.js', array('jquery'), null, false);
    //wp_enqueue_script('moments', get_template_directory_uri() . '/assets/js/moments.js', array('jquery'), null, false);
    //wp_enqueue_script('moments-timezone', get_template_directory_uri() . '/assets/js/moments-timezone.js', array('jquery'), null, false);
    wp_enqueue_script('paginaiton', get_template_directory_uri() . '/assets/js/pagination.min.js', array('jquery'), null, false);
    wp_enqueue_script('face_detection', get_template_directory_uri() . '/assets/js/face-api.min.js', array('jquery'), null, false);

    


    //wp_enqueue_script('Stripe', "https://js.stripe.com/v3/", array('jquery'), null, false);
    //wp_enqueue_script('Jquery_Popup', "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js", array('jquery'), null, false);
    wp_enqueue_script('TweenMax', "https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js", array('jquery'), null, false);
    //wp_enqueue_script('chart', "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js", array('jquery'), null, false);
    //wp_enqueue_script('MOdernizer', "https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js", array('jquery'), null, false);
    wp_enqueue_script('socket.io', 'https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js', array('jquery'), null, false);
    

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/ajax-login-script.js', array('jquery'));
    wp_enqueue_script('ajax-login-script');
    wp_localize_script('ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...'),
        'site_url' => get_template_directory_uri()
    ));
  

    wp_enqueue_script('ibenic-uploader', get_template_directory_uri() .  '/assets/js/uploader.js', array('jquery'), '1.0', true);
    wp_localize_script('ibenic-uploader', 'ibenicUploader', array('ajax_url' => admin_url('admin-ajax.php'))
    );
    wp_enqueue_script('emojionearea', get_template_directory_uri() . '/assets/js/emojionearea.min.js', array('jquery'), null, false);
}
add_action('wp_enqueue_scripts', 'dating_scripts');


add_action( 'wp_enqueue_scripts', 'ibenic_enqueue' );

function ibenic_enqueue() {
  wp_enqueue_script( 'ibenic-uploader', plugins_url ('assets/js/uploader.js, dirname( __FILE__ ) '), array('jquery'), '1.0', true );
  wp_localize_script( 'ibenic-uploader', 'ibenicUploader',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
