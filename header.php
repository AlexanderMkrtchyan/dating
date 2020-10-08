<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="#" />
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


	<?php wp_head(); ?>

</head>

<div id="preloader">
	<div class="clear-loading loading-effect"><img src="<?php echo get_template_directory_uri() . '/assets/images/loading.gif' ?>" alt="" /></div>
</div>

<header id="header" class="dark">
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">

				</div>
				<div class="col-md-6">
					<div class="topbar-right text-right">
						<ul class="list-inline social-icons color-hover">
							<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
						<ul class="list-inline text-uppercase top-menu">
							<?php if (is_user_logged_in()) { ?>
								<li>
								<a class="login_button register_login logged_in_user" href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
												<img class="login_image" src="<?php echo wp_get_attachment_image_src( get_user_meta(get_current_user_id(), 'profile_image')[0], 'thumbnail',  true )[0]; ?>" alt="Profile Image" />
			</li>
							<?php } else { ?>
								<li style="margin:6px;"><a class="register_login" href="<?php echo get_permalink(get_page_by_title('registration')) ?>">JOin</a></li>
								<a class="login_button register_login logged_out_user" type="submit" id="show_login" href="">Login to The Quest</a>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--=================================
 mega menu -->
	<input type="hidden" class="gender_hidden" name="hidden_gender" placeholder="" value="<?php echo get_user_meta(get_current_user_id(), 'gender')[0] ?>">
	<div class="menu">
		<!-- menu start -->
		<nav id="menu" class="mega-menu">
			<!-- menu list items container -->
			<div class="menu-list-items">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- menu logo -->
							<ul class="menu-logo">
								<li> <a class="logo_cupid" href="<?php echo get_home_url() ?>">
										<img src="<?php if (get_user_meta(get_current_user_id(), 'gender')[0] == "Female") {
														echo get_template_directory_uri() . '/assets/images/logo22.png';
													} else {
														echo get_template_directory_uri() . '/assets/images/logo33.png';
													} ?>" alt="logo">
									</a> </li>
							</ul>
							<!-- menu links -->
							<ul class="menu-links">
								<!-- active class -->



								<?php if (is_user_logged_in()) {
									$userdata = get_user_by('id', $user_ID);
									?>
									<li class="active"><a  href="<?php echo get_home_url() ?>"> Home </a>
									</li>
									<li class="vertical_li">
										<div class="vertical_line"></div>
									</li>
									<li><a  href="<?php echo get_permalink(get_page_by_path('Profile')); ?>">My Profile</a>
									</li>
									<?php if (get_user_meta(get_current_user_id(), 'gender')[0] == "Female") {
										?>
										<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('chatf')); ?>">
										<?php
									}else{
										?>
										<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('chatm')); ?>">
										<?php
									}
									
									?>
									
									<?php
									if(get_user_meta($user_ID, 'gender', true) == "Male"){
										echo 'My Chats';
									}else{
										echo 'My Guys';
									}
									?></a>
									</li>
									<?php
									if(get_user_meta($user_ID, 'gender', true) == "Male"){
										?>
										<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('questm')); ?>">My Quest</a>
									<?php
									}elseif(get_user_meta($user_ID, 'gender', true) == "Female"){
										?>
										<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('questf')); ?>">My Quest</a>
									<?php
									}else{
										?>
										<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('questv')); ?>">My Quest</a>
										<?php
									}
									?>
									
									
									<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('wheel')); ?>">The Wheel</a>
									</li>
									<li><a href="<?php echo get_permalink(get_page_by_path('blog-page')); ?>">My Blogs</a>
									<?php
									} ?>


									<?php if (!is_user_logged_in()) {
										?>
									<li class="active"><a  href="<?php echo get_home_url() ?>"> Home </a>
									</li>
									<li class="vertical_li">
										<div class="vertical_line"></div>
									</li>
									<li><a  href="<?php echo esc_url(get_permalink(get_page_by_path('questv')));?>">Take a Tour</a></li>
									<li><a  href="<?php echo get_permalink(get_page_by_path('questv')); ?>">Join The Quest</a></li>
									<li class="my_girls"><a  href="<?php echo get_permalink(get_page_by_path('wheel')); ?>">The Wheel</a>
									</li>
									<li><a href="<?php echo get_permalink(get_page_by_path('blog-page')); ?>">Blog-ling the Mind</a>
									<?php
									} ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<!-- menu end -->
	</div>
</header>

<body  <?php body_class(); ?>>

	<form id="login" action="login" method="post">
		<div class="login-form login-img dark-bg page-section-ptb100 " style="background: url(<?php echo get_template_directory_uri() . '/assets/images/pattern/04.png' ?>) no-repeat 0 0; background-size: cover;">
			<h1>Site Login</h1>
			<p class="status"></p>
			<div class="section-field mb-2">
				<div class="field-widget"> <i class="glyph-icon flaticon-user"></i>
					<input placeholder="Username" autocomplete="username" id="username" type="text" name="username">
				</div>
			</div>
			<div class="section-field mb-1">
				<div class="field-widget"> <i class="glyph-icon flaticon-padlock"></i>
					<input placeholder="Password" autocomplete ="current-password" id="password" type="password" name="password">
				</div>
			</div>


			<div class="section-field text-uppercase text-center mt-2">
				<input class=" button  btn-lg btn-theme full-rounded animated right-icn submit_button" type="submit" value="Login" name="submit">
			</div>
			<a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Forgot password?</a>
			<!--input class="submit_button" type="submit" value="Login" name="submit"-->
			<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
		</div>
	</form>
	<script>
$('.logged_in_user').on('click', ()=>{
	function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
setCookie('logged_out', 'yes', 2000)
})
$('.logged_out_user').on('click', ()=>{
	document.cookie = 'logged_out' + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
})

	</script>