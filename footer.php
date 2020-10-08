<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dating
 */

?>

<footer class="page-section-pt text-white text-center black_color">
	<p style="float: left; color: white;">© 2019 - All Right Reserved </p>
	<div class="footer_links">
		<ul>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">Take a Tour</a></li>
		</ul>
		<ul>
			<li><a href="#">Terms of Use</a></li>
			<li><a href="#">Privacy Policy</a></li>
		</ul>
	</div>
	<div class="container">

		<div class="footer-widget  sm-mt-3">


			<div class="container">

				<div class="row justify-content-center">
					<div class="col-md-8 ">
						<div class="footer-logo col d-flex align-items-center justify-content-center"> <img class="img-center" src="<?php if (get_user_meta(get_current_user_id(), 'gender')[0] == "Female") {
																																		echo get_template_directory_uri() . '/assets/images/pattern/04.png';
																																	} else {
																																		echo get_template_directory_uri() . '/assets/images/logo33.png';
																																	} ?>" alt="logo" /> </div>




					</div>
				</div>
			</div>

		</div>
	</div>
</footer>

<!--=================================
footer -->

<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-level-up"></i></a></div>


<?php wp_footer(); ?>
</div>
</body>

</html>