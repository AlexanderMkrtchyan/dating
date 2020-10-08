<?php
/* 
Template Name: Female Registration Page
*/

ob_start();
include('chat_config.php');
                

get_header()
?>
<?php  ?>
<div class="wrapper">

    <?php
    $error = '';
    $success = '';

    global $wpdb, $PasswordHash, $current_user, $user_ID;

    if (isset($_POST['task']) && $_POST['task'] == 'register') {

        //Getting user IP and insert into DB
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }



        $matches = [];
        $query = $db->prepare("SELECT * from user_ip_address ");
		$query->execute();

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
        foreach($results as $ip){
            if($ip['user_ip'] == $ip_address){
                array_push($matches, $ip['user_id']);
            break;
            }
        }
        if(count($matches) != 0){
            echo '<div class="match">Seems, you are already have a ' . get_user_meta($matches[0], 'gender')[0]  . ' account...</div>';
        }else{
            $password1 = $wpdb->escape(trim($_POST['password1']));
            $password2 = $wpdb->escape(trim($_POST['password2']));
            $first_name = $wpdb->escape(trim($_POST['first_name']));
            $last_name = $wpdb->escape(trim($_POST['last_name']));
            $email = $wpdb->escape(trim($_POST['email']));
            $username = $wpdb->escape(trim($_POST['username']));
            $age = $wpdb->escape(trim($_POST['age']));
            

            setcookie('username', time()-36000);
            setcookie('usname', $username, time() + (86400 * 30), "/");
            
            

    
            if ($email == "" || $password1 == "" || $password2 == "" || $username == "" || $first_name == "" || $last_name == "") {
                $error = '<div style="color:white">Please don\'t leave the  fields.</div>';
    
    
    
            } else  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = '<div style="color:white">Invalid email address.</div>';
            } else  if (email_exists($email)) {
                $error = '<div style="color:white">Email already exist.</div>';
            } else  if ($password1 <> $password2) {
                $error = '<div style="color:white">Password do not match.</div>';
            } else {
    
                $user_id = wp_insert_user(array('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $password1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber'), [ 'show_in_rest' => true ]);
    
                if (is_wp_error($user_id)) {
                    $error = 'Error on user creation.';
                } else {
                    do_action('user_register', $user_id);
                    add_filter('registration_redirect', 'my_redirect_home');
                    wp_redirect(home_url());
    
                    $success = 'You\'re successfully register';
                    if (isset($_POST['gender'])) {
    
                        update_user_meta($user_id, 'gender', $_POST['gender']);
                       
                    }
                    if (isset($_POST['time_offset_registration'])) {
                        
                       
                        update_user_meta($user_id, 'time_offset_registration', $_POST['time_offset_registration']);
                    }
                    if (isset($_POST['city'])) {
                       
                        update_user_meta($user_id, 'city', $_POST['city']);
                        update_user_meta($user_id, 'profile_image', get_template_directory_uri() . '/assets/images/no_person.png');
                    }
                    if (isset($_POST['state'])) {
                       
                        update_user_meta($user_id, 'state', $_POST['state']);
                    }
                    if (isset($_POST['age'])) {
                        $date = new DateTime($_POST['age']);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        $year = $interval->y;
                        update_user_meta($user_id, 'age', $year);
                    }
    
    
                    
    
                    $sql = "INSERT INTO user_ip_address (user_id, user_ip) VALUES ($user_id, '$ip_address')";
                    $query = $db->prepare($sql);
                    $query->execute();
                         
    
                    
                  
                    
                }
            }
        }

        

    }

    ?>
    <!--display error/success message-->
    <div id="message">
        <?php
        if (!empty($err)) :
            echo '<p class="error" style="color:white;" > ' . $err . '';
        endif;
        ?>

        <?php
        if (!empty($success)) :
            echo '<p class="error" > ' . $success . '';


        endif;
        ?>
    </div>

    <form method="POST">


        <section class="login-form register-img dark-bg page-section-ptb"
            style="background: url(<?php echo get_template_directory_uri() . '/assets/images/pattern/04.png' ?>) no-repeat 0 0; background-size: cover;">
            <div class="container">
                <div class="row  justify-content-center">
                    <div class="col-md-6">
                        <div class="login-1-form register-1-form clearfix text-center">
                            <h4 class="title divider-3 text-white mb-3">Join the Quest</h4>
                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="glyph-icon flaticon-user"></i>
                                    <input type="text" value="" name="first_name" placeholder="First Name"
                                        id="first_name" />
                                </div>
                            </div>
                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="glyph-icon flaticon-user"></i>
                                    <input type="text" value="" placeholder="Last Name" name="last_name"
                                        id="last_name" />
                                </div>
                            </div>
                            <div class="section-field mb-4">
                                <div class="field-widget"> <i class="glyph-icon flaticon-user" aria-hidden="true"></i>
                                    <input type="text" value="" placeholder="Username" name="username" id="username" />
                                </div>
                            </div>
                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="glyph-icon flaticon-user" aria-hidden="true"></i>
                                    <input type="text" class="city_input_registration" value="" name="city_field"
                                        placeholder="Type your city"  />
                                </div>
                            </div>

                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <input type="text" value="" placeholder="Email" name="email" id="email" />
                                </div>
                            </div>
                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="glyph-icon flaticon-padlock"></i>
                                    <input type="password" value="" placeholder="password" name="password1"
                                        id="password1" />
                                </div>
                            </div>
                            <div class="section-field mb-3">
                                <div class="field-widget"> <i class="glyph-icon flaticon-padlock"></i>
                                    <input type="password" value="" placeholder="confirm password" name="password2"
                                        id="password2" />
                                    <div class="alignleft">
                                        <p><?php if ($sucess != "") { } ?> <?php if ($error != "") {
                                                                                echo $error;
                                                                            } ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="section-field mb-4">
                            <div class="age_field">
                                    <div class="date_of_birth">
                                        <input type="date" class="birth_date" name="age" value="" min="1945-01-01"
                                            max="2001-12-01" >
                                    </div>
                                </div>
                            </div>


                            <span><input type="checkbox" name="agreement" id="agreement" value=""
                                    placeholder="" ><span style="color:aliceblue; margin-left:10px; line-height: 45px;">I
                                    acknowledge that I am at least 18 years of age</span></span>
                            <div class="clearfix"></div>
                            <button type="submit" name="btnregister" class="button">Submit</button>
                            <input type="hidden" name="task" value="register" />

                            <input type="hidden" class="time_offset_registration" name="time_offset_registration"
                                value="">
                                <input type="hidden" name="gender" value="Female">
                            <input type="hidden" class='state_registration' name="state" value="">
                            <input type="hidden" class="city" name="city" value="">
                            <div class="clearfix"></div>
                            <div class="section-field mt-2 text-center text-white">
                                <p class="lead mb-0">Have an account? <a class="text-white"
                                        href="<?php echo get_site_url(); ?>"><u>Sign In!</u> </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </form>
</div>


<script>
    



    TeleportAutocomplete.init('.city_input_registration').on('change', function (value) {
        if (value !== null) {
            $('.time_offset_registration').val(value['tzOffsetMinutes'])
            $('.state_registration').val(value['admin1Division'])
            $('.city').val(value['name'])
        }
    });
</script>
<?php

get_footer();
ob_end_flush(); ?>