<?php
/*Template name: Sign in Page*/
get_header();

global $user_ID;
global $wpdb;
if (!$user_ID) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $wpdb->escape($_POST['name']);
        $password = $wpdb->escape($_POST['password']);

        $login_array = array();
        $login_array['user_login'] = $username;
        $login_array['user_password'] = $password;

        $verify_user = wp_signon($login_array, true);

        if (is_wp_error($verify_user)) {
            echo "<p>Invalid Username/login</p>";
        } else {
            echo "<script>window.location = '" . site_url() . "'</script>";
        }
    } else {

        ?>


        <!--=================================
                                         inner-intro-->

        <section class="inner-intro bg bg-fixed bg-overlay-black-60" style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/bg/inner-bg-1.jpg' ?>);">
            <div class="container">
                <div class="row intro-title text-center">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h1 class="position-relative divider">login <span class="sub-title">login</span></h1>
                        </div>
                    </div>
                    <div class="col-md-12 mt-7">
                        <ul class="page-breadcrumb">
                            <li><a href="index-default.html"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
                            <li><a href="login.html">Pages</a> <i class="fa fa-angle-double-right"></i></li>
                            <li><span>Login 1</span> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
                                         inner-intro-->

        <!--=================================
                                         login-->

        <section class="login-form login-img dark-bg page-section-ptb100 " style="background: url(<?php echo get_template_directory_uri() . '/assets/images/pattern/04.png' ?>) no-repeat 0 0; background-size: cover;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="login-1-form clearfix text-center">
                            <h4 class="title divider-3 text-white">SIGN IN</h4>
                            <div class="login-1-social mt-5 mb-5 text-center clearfix">
                                <ul class="list-inline text-capitalize">
                                    <li><a class="fb" href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                                    <li><a class="gplus" href="#"><i class="fa fa-google-plus"></i> google+</a></li>
                                </ul>
                            </div>
                            <form id="login" action="login" method="post">
                                <div class="section-field mb-2">
                                    <div class="field-widget"> <i class="glyph-icon flaticon-user"></i>
                                        <input id="name" class="web" type="text" placeholder="User name" name="name">
                                    </div>
                                </div>
                                <div class="section-field mb-1">
                                    <div class="field-widget"> <i class="glyph-icon flaticon-padlock"></i>
                                        <input id="Password" class="Password" type="password" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <div class="section-field text-uppercase"> <a href="#" class="float-right text-white">Forgot Password?</a> </div>
                                <div class="clearfix"></div>
                                <div class="section-field text-uppercase text-center mt-2">
                                    <a class="button  btn-lg btn-theme full-rounded animated right-icn" type="submit" value="Login" name="submit">
                                        <span>sign in<i class="glyph-icon flaticon-hearts" aria-hidden="true"></i></span>
                                    </a>
                                </div>
                            </form>
                            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                            <div class="clearfix"></div>
                            <div class="section-field mt-2 text-center text-white">
                                <p class="lead mb-0">Don’t have an account? <a class="text-white" href="register.html"><u>Register now!</u> </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
                                         login-->









    <?php
    }
}
get_footer();
