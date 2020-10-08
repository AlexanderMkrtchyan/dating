<?php

/**
 * dating functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dating
 */

if (!function_exists('dating_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dating_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dating, use a find and replace
		 * to change 'dating' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('dating', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'dating'),
		));

		function wpb_filter_query( $query, $error = true ) {
			if ( is_search() ) {
				$query->is_search = true;
				$query->query_vars[s] = true;
				$query->query[s] = true;
				if ( $error == true )
					$query->is_404 = true;
			}
		}
		add_action( 'parse_query', 'wpb_filter_query' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('dating_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'dating_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dating_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('dating_content_width', 640);
}
add_action('after_setup_theme', 'dating_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dating_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'dating'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'dating'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'dating_widgets_init');



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom post types.
 */
require get_template_directory() . '/inc/dating-post-types.php';
require get_template_directory() . '/inc/ajax_upload_test.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/enque-scripts.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Carbon fields
 */

require get_template_directory() . '/inc/carbon-fields.php';

/** Login form */



function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
	add_action('init', 'ajax_login_init');
}

function ajax_login()
{

	// First check the nonce, if it fails the function will break
	check_ajax_referer('ajax-login-nonce', 'security');

	// Nonce is checked, get the POST data and sign user on
	$info = array();
	$info['user_login'] = $_POST['username'];
	$info['user_password'] = $_POST['password'];
	//$info['remember'] = true;

	$user_signon = wp_signon($info, false);
	if (is_wp_error($user_signon)) {
		echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
	} else {



		// my_setcookie() set the cookie on the domain and directory WP is installed on

		$path = '/';
		$expiry = strtotime('+1 month');
		setcookie('user_name', $_POST['username'], $expiry, $path);
		/* more cookies */
		setcookie('user_name2',$_POST['username'], time() + 99999999, '/');

		echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
	}

	die();
}



if (!is_user_logged_in() && isset($_COOKIE['logged_out'])) {
	if($_COOKIE['logged_out'] != 'yes'){
		function auto_login() {
			// @TODO: change these 2 items
			//$loginpageid   = '1234'; //Page ID of your login page
			$loginusername = $_COOKIE['user_name2']; //username of the WordPress user account to impersonate
		
			// get this username's ID
			$user = get_user_by( 'login', $loginusername );
		
			// only attempt to auto-login if at www.site.com/auto-login/ (i.e. www.site.com/?p=1234 ) and a user by that username was found

		
			$user_id = $user->ID;
		
			// login as this user
			wp_set_current_user( $user_id, $loginusername );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $loginusername, $user );
		
			// redirect to home page after logging in (i.e. don't show content of www.site.com/?p=1234 )
			exit;
		}
		
		add_action( 'wp', 'auto_login', 1 );

	}

}








if ( function_exists( 'add_image_size' ) ) { 
    add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
    add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
}
add_theme_support('post-thumbnails');
add_image_size( 'square', 500, 500,true );
add_image_size('news-big', 370, 240, true);
add_image_size('news-small',270,150,true);
add_image_size('portfolio-big',370,500,true);
add_image_size('portfolio-small',270,350,true);


add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

/**User access to profile page */
add_action('init', 'prevent_profile_access');

function prevent_profile_access()
{
	if (current_user_can('manage_options')) return '';

	if (strpos($_SERVER['REQUEST_URI'], 'wp-admin/profile.php')) {
		wp_redirect(get_site_url() . '/profile');
		die();
	}
}




/** Show only users own images in profile */


function only_show_user_images($query)
{

	$current_userID = get_current_user_id();

	if ($current_userID && !current_user_can('manage_options')) {

		$query['author'] = $current_userID;
	}

	return $query;
}



/**Deleting files from media library */
add_action('wp_ajax_delete_attachment', 'delete_attachment');
function delete_attachment($post)
{
	$response = array();
	//echo $_POST['att_ID'];
	$msg = 'Attachment ID [' . $_POST['att_ID'] . '] has been deleted!';
	$attID = attachment_url_to_postid($_POST['att_ID']);
	wp_delete_attachment($attID, true);
	if (wp_delete_attachment($_POST['att_ID'], true)) {
		echo $msg;
	}
	die();
}


  


function kv_handle_attachment($file_handler, $post_id, $set_thu = false)
{
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload($file_handler, $post_id);
	$src_full = wp_get_attachment_image_src($attach_id, 'full');
	if($src_full){

		$url = "https://api.sightengine.com/1.0/nudity.json?api_user=777117361&api_secret=Uf6Q5zHAqtvKfffNHUvC&url=" . $src_full[0];
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
		$json = curl_exec($ch);
		if(!$json) {
			echo curl_error($ch);
		}
		curl_close($ch);
		$arr = json_decode($json, true);
		//print_r(json_decode($json));
		if($arr['nudity']['raw'] > 0.3)
		{
			carbon_set_post_meta($attach_id, 'privat_image', 'private');
		}
		
	}

	?>
	        <script>
        
        $.get('https://api.sightengine.com/1.0/nudity.json?api_user=777117361&api_secret=Uf6Q5zHAqtvKfffNHUvC&url=' + '<?php echo  $src_full[0]?>',
                  function(response) {
					  console.log(response)
					  console.log(response['nudity']['raw'])
                  });
        </script>
		
	<?php

	// If you want to set a featured image frmo your uploads. 
	if ($set_thu) set_post_thumbnail($post_id, $attach_id);
	return $attach_id;
}

add_filter('registration_redirect', 'my_redirect_home');
function my_redirect_home($registration_redirect)
{
	return home_url();
}


/**
 * @snippet       Display All Products Purchased by User via Shortcode - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.3
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_shortcode('my_purchased_products', 'bbloomer_products_bought_by_curr_user');

function bbloomer_products_bought_by_curr_user()
{

	// GET CURR USER
	$current_user = wp_get_current_user();
	if (0 == $current_user->ID) return;

	// GET USER ORDERS (COMPLETED + PROCESSING)
	$customer_orders = get_posts(array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => $current_user->ID,
		'post_type'   => wc_get_order_types(),
		'post_status' => array_keys(wc_get_is_paid_statuses()),
	));

	// LOOP THROUGH ORDERS AND GET PRODUCT IDS
	if (!$customer_orders) return;
	$product_ids = array();
	foreach ($customer_orders as $customer_order) {
		$order = wc_get_order($customer_order->ID);
		$items = $order->get_items();
		foreach ($items as $item) {
			$product_id = $item->get_product_id();
			$product_ids[] = $product_id;
		}
	}
	$product_ids = array_unique($product_ids);
	$product_ids_str = implode(",", $product_ids);

	// PASS PRODUCT IDS TO PRODUCTS SHORTCODE
	return do_shortcode("[products ids='$product_ids_str']");
}


function start_session()
{
	if (!session_id()) {
		session_start();
	}
}

add_action('init', 'start_session', 1);

function end_session()
{
	session_destroy();
}

add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');









// Geting new endpoints






add_filter( 'rest_user_query' , 'custom_rest_user_query' );
function custom_rest_user_query( $prepared_args, $request = null ) {
  unset($prepared_args['has_published_posts']);
  return $prepared_args;
}





add_action( 'rest_api_init', 'adding_user_meta_rest' );

function adding_user_meta_rest() {
   register_rest_field( 'user',
						'age',
						 array(
						   'get_callback'      => 'user_meta_callback',
						   'update_callback'   => null,
						   'schema'            => null,
							)
					  );
					  register_rest_field( 'user',
						'city',
						 array(
						   'get_callback'      => 'user_meta_callback',
						   'update_callback'   => null,
						   'schema'            => null,
							)
					  );
					  register_rest_field( 'user',
						'state',
						 array(
						   'get_callback'      => 'user_meta_callback',
						   'update_callback'   => null,
						   'schema'            => null,
							)
					  );
					  register_rest_field( 'user',
						'relationship',
						 array(
						   'get_callback'      => 'user_meta_callback',
						   'update_callback'   => null,
						   'schema'            => null,
							)
					  );
					  register_rest_field( 'user',
						'profile_image',
						 array(
						   'get_callback'      => 'user_meta_callback',
						   'update_callback'   => null,
						   'schema'            => null,
							)
					  );
					  
}

function user_meta_callback( $user, $field_name, $request) {
	return get_user_meta( $user[ 'id' ], $field_name, true );
}




add_action( 'rest_api_init', function () {
	register_rest_route( 'myplugin/v1', '/user/(?P<meta>\S+)', array(
	  'methods' => 'GET',
	  'callback' => 'my_awesome_func',
	) );
  } );

  function my_awesome_func($data) {
	$klir =  get_users( array( 'fields' => array( 'ID' ) ) );
	$gandon = [];
    //$users = get_user_meta(1, $data['meta'], true);
   
	foreach($klir as $puc){
		$meta = get_user_meta($puc->ID, $data['meta'], true);
		array_push($gandon, $meta);
	}
	return $gandon;
  }


  add_action( 'wp_ajax_update_user_info', 'update_user_info');
  function update_user_info() {
	  if(empty($_POST) || !isset($_POST)) {
		  ajaxStatus('error', 'Nothing to update.');
	  } else {
		  try {



			// если не авторизован, просто выходим из файла
			if (!is_user_logged_in()) exit;
			$user_ID = get_current_user_id();
			$user = get_user_by('id', $user_ID);
			$error = [];
			if ($_POST['pwd1'] || $_POST['pwd2'] || $_POST['pwd3']) {

				// при этом пользователь должен заполнить все поля
				if ($_POST['pwd1'] && $_POST['pwd2'] && $_POST['pwd3']) {
			
					// сначала проверяем соответствие нового пароля и его подтверждения
					if ($_POST['pwd2'] == $_POST['pwd3']) {
			
						// пароль из двух символов нам не нужен, минимум 8
						if (strlen($_POST['pwd2']) < 8) {
							// если слишком короткий - перенаправляем
							array_push($error, 'password should be longer than 8 characters');
						}
			
						// и самое главное - проверяем, правильно ли указан старый пароль
						if (wp_check_password($_POST['pwd1'], $user->data->user_pass, $user->ID)) {
							// если да, меняем на новый и заново авторизуем пользователя
							wp_set_password($_POST['pwd2'], $user_ID);
							$creds['user_login'] = $user->user_login;
							$creds['user_password'] = $_POST['pwd2'];
							$creds['remember'] = true;
							$user = wp_signon($creds, false);
						} else {
							// если нет, перенаправляем на ошибку
							array_push($error, "wrong current password");
						}
					} else {
						// новый пароль и его подтверждение не соответствуют друг другу
						array_push($error, 'passwords don\'t match');
						
					}
				} else {
					// не все поля заполнены - перенеправляем
					array_push($error, 'required all fields');
				}
			}

			if ($_POST['first_name'] && $_POST['last_name'] && is_email($_POST['email'])) {
				// если пользователь указал новый емайл, а кто-то уже под ним зареган - отправляем на ошибку
				if (email_exists($_POST['email']) && $_POST['email'] != $user->user_email) {
					array_push($error, 'email exist');
				}
			
				// updating user meta
				wp_update_user(array(
					'ID' => $user_ID,
					'user_email' => $_POST['email'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'display_name' => $_POST['first_name'] . ' ' . $_POST['last_name'],
					'age' => $_POST['age'],
				));
			
				
			}
			// Updating user meta
			if($_POST['klri_glox'] != ''){
				$default_img_id =  attachment_url_to_postid($_POST['klri_glox']);
				update_user_meta($user_ID, 'profile_image', $default_img_id);
				update_user_meta($user_ID, 'profile_image', wp_get_attachment_image_src( $default_img_id, 'thumbnail',  true )[0]); 
			}

			
if($_POST['image_checkbox']){
    $string =  $_POST['image_checkbox'];
    
    $str_arr = preg_split("/\,/", $string);
    foreach($str_arr as $puc){
        carbon_set_post_meta($puc, 'privat_image', 'private');
    }
}

if($_POST['video_click']){
    $link = $_POST['video_click'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        carbon_set_post_meta($id, 'private_video', 'private_vd');
    }
}
if($_POST['unset_video_click']){
    $link = $_POST['unset_video_click'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        carbon_set_post_meta($id, 'private_video', '');
    }
}
if($_POST['delete_vid']){
    $link = $_POST['delete_vid'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        wp_delete_attachment($id);
    }
}
		if(isset($_POST['smoking'])){
			update_user_meta($user_ID, 'smoking', $_POST['smoking']);
		}	
			//$default_img_link = wp_get_attachment_image_src( $default_img_id, 'thumbnail',  true )[0];
		
			update_user_meta($user_ID, 'drinking', $_POST['drinking']);
			if(isset($_POST['gender'])){update_user_meta($user_ID, 'gender', $_POST['gender']);}
			
			update_user_meta($user_ID, 'ethnicity', $_POST['ethnicity']);
			update_user_meta($user_ID, 'looking_for', $_POST['looking_for']);
			update_user_meta($user_ID, 'looking_for_in', $_POST['looking_for_in']);
			
			
			update_user_meta($user_ID, 'age', $_POST['age']);
			update_user_meta($user_ID, 'puc', $_POST['puc']);
			
			update_user_meta($user_ID, 'time_offset_registration', $_POST['time_offset_registration']);
		
			update_user_meta($user_ID, 'education', $_POST['education']);
		
			update_user_meta($user_ID, 'about_me', $_POST['about_me']);
			update_user_meta($user_ID, 'hobby', $_POST['hobby']);
			update_user_meta($user_ID, 'size', $_POST['size']);
			update_user_meta($user_ID, 'user_select', $_POST['user_select']);
			update_user_meta($user_ID, 'user_tatoo', $_POST['user_tatoo']);
			update_user_meta($user_ID, 'piercings', $_POST['piercings']);
			update_user_meta($user_ID, 'hair_color', $_POST['hair_color']);
			update_user_meta($user_ID, 'eye_color', $_POST['eye_color']);
			update_user_meta($user_ID, 'relationship', $_POST['relationship']);
			update_user_meta($user_ID, 'kids', $_POST['kids']);
			
		
			update_user_meta($user_ID, 'language', $_POST['language']);
			update_user_meta($user_ID, 'income', $_POST['income']);
			update_user_meta($user_ID, 'age', $_POST['age']);

			if($_POST['delete_image']){
    
				$string =  $_POST['delete_image'];
				$tempData = str_replace("\\", "",$string);
				$cleanData = json_decode($tempData);
			
				foreach($cleanData as $img_src){
					wp_delete_attachment($img_src,false);        
				}
			}
			  echo json_encode($error);
			  die();
		  } catch (Exception $e){
			  echo 'Caught exception: ',  $e->getMessage(), "\n";
		  }
	  }
  }



  function crb_insert_attachment_from_url($image_url, $parent_post_id = null, $user_id) {
	  
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    var_dump($image_data);


    // $imginfo = getimagesize($remoteImage);
    // header("Content-type: {$imginfo['mime']}");
    // $image_metadata = readfile($remoteImage);
    // var_dump($image_data);

    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path'])){
        $file = $upload_dir['path'] . '/' . $filename;
    } else{
        $file = $upload_dir['basedir'] . '/' . $filename;
    }
    file_put_contents($file, $image_data);
    
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_author' => $user_id,
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit',
        'post_parent' => 0
    );
        $attach_id = wp_insert_attachment( $attachment, $file, $post_ID );

        require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    
    set_post_thumbnail( $post_ID, $attach_id );
    $thumbnail_src = wp_get_attachment_thumb_url($attach_id);
    update_user_meta($user_id, 'profile_image', $thumbnail_src);
    return $attach_id;
}

