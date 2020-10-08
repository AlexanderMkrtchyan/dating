<?php
/*Template name: Custom Login Page*/


global $user_ID;
global $wpdb;
if(!$user_ID){

    if($_POST){

        $username = $wpdb->escape($_POST['loginUsername']);
        $password = $wpdb->escape($_POST['loginPassword']);
        $remember = $wpdb->escape($_POST['remember']);

        $login_array = array();
	    $login_array['user_login'] = $username;
        $login_array['user_password'] = $password;
        $login_array['user_remember'] = $remember;

        $verify_user = wp_signon($login_array, true);

        if(is_wp_error($verify_user)){
	        echo "<p>Invalid Username/login</p>";

        }else{
	        echo "<script>window.location = '".site_url()."'</script>";
        }

    }else{

        ?>
	    <div class="modal-content">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<div class="ms-login-form">

        <form id="login" action="login" method="post">
			<div class="ms_width_off50">
				<div class="ms-heading2">
					<h3>Sign in</h3>
					<p>welcome back! sign in to your account</p>
				</div>

				<div class="input-felid">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username">
				</div>
				<div class="input-felid">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password">

				</div>
				<div class="pull-left">
					<input type="checkbox" name="remember" id="clik">
					<span class="box"></span>
					<label for="clik" class="ck-title">remember me</label>
				</div>
				<div class="pull-right">
                    <a class="lost fpw" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>

				</div>
				<div class="btn-submit">
                    <input class="submit_button btn-normal2" type="submit" value="Login" name="submit">
                    <a class="btn-normal2 float_right_button" href="<?php echo esc_url( get_permalink( get_page_by_title( 'registration' ) ) ); ?>">or register</a>
				</div>
			</div>
	        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>


    </div>
		</form>

	</div>

</div>
        <?php
    }




}