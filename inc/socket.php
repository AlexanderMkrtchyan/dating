
<?php
/*
Template Name: socket
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









<?php 
get_footer();
