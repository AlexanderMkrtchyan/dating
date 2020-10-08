<?php

/**
 * Template Name: Blog Page
 */
get_header();
?>
<main class="log-main">
<section class="blog_section">
    <div style="background: bisque;" class="blog_section">
    
        

        <?php if (is_user_logged_in()) { ?>
            <div class="container" style="text-align: center; ">
            <h2 style="color: black" class="title divider mb-3 text-shadow my_blogs">My blogs</h2>

            <div class="pl_login">Please login</div>
        </div>
            <div class="logged_in_blog">
            
                <?php if (get_user_meta(get_current_user_id(), 'gender')[0] == 'Male') : ?>
                    <div class="page-section-ptb grey-bg blogs_for_men animated fadeInRight log_boys flex-container">
                        <div class="container">
                            <div class="row justify-content-center mb-5 sm-mb-2">
                                <div class="col-md-10 text-center">
                                    <h2 style="text-shadow: 3px 3px #f73af9;width: 100%; text-align: center;">Blogs for Men</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container my-container">
                            <?php
                                    $args = array(
                                        'post_type' => 'mens_world',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 4
                                    );

                                    $my_query = null;
                                    $my_query = new WP_Query($args);

                                    if ($my_query->have_posts()) {

                                        $i = 0;
                                        while ($my_query->have_posts()) : $my_query->the_post();

                                            // modified to work with 3 columns
                                            // output an open <div>
                                            if ($i % 2 == 0) { ?>
                                        <div class="row">
                                        <?php } ?>

                                        <div style="margin: 10px 0;" class="col-md-6 outer_box">
                                            <div class="gradient-border" id="box">
                                                <div class="my-inner">

                                                    <div class="the_title_of_blog">
                                                        <h1 class="the_title_of_blog"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?></a></h1>
                                                    </div>
                                                    <div class="front_end_blog_image" style="float:left"><?php echo get_the_post_thumbnail(); ?>
                                                    </div>
                                                    <div class="blog_page_content animated flash"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></div>
                                                </div>
                                            </div>

                                        </div>

                                        <?php $i++;
                                                        if ($i != 0 && $i % 2 == 0) { ?>
                                        </div>
                                        <!--/.row-->
                                        <div class="clearfix"></div>

                                    <?php } ?>

                            <?php
                                        endwhile;
                                    }
                                    wp_reset_query();
                                    ?>



                        </div>


                    </div>

                <?php endif; ?>
                <?php if (get_user_meta(get_current_user_id(), 'gender')[0] == 'Female') : ?>
                    <div class="page-section-ptb grey-bg blogs_for_girls animated fadeInRight log_girls flex-container">
                        <div class="container">
                            <div class="row justify-content-center mb-5 sm-mb-2">
                                <div class="col-md-10 text-center">
                                    <h2 style="text-shadow: 3px 3px #f73af9;width: 100%; text-align: center;">Blogs for Women</h2>
                                </div>
                            </div>
                        </div>
                        <div class="container my-container">
                            <?php
                                    $args = array(
                                        'post_type' => 'girls_blog',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 4
                                    );

                                    $my_query = null;
                                    $my_query = new WP_Query($args);

                                    if ($my_query->have_posts()) {

                                        $i = 0;
                                        while ($my_query->have_posts()) : $my_query->the_post();

                                            // modified to work with 3 columns
                                            // output an open <div>
                                            if ($i % 2 == 0) { ?>
                                        <div class="row">
                                        <?php } ?>

                                        <div style="margin: 10px 0;" class="col-md-6 outer_box">
                                            <div class="gradient-border" id="box">
                                                <div class="my-inner">

                                                    <div class="the_title_of_blog">
                                                        <h1 class="the_title_of_blog"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?></a></h1>
                                                    </div>
                                                    <div class="front_end_blog_image" style="float:left"><?php echo get_the_post_thumbnail(); ?>
                                                    </div>
                                                    <div class="blog_page_content animated flash"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></div>
                                                </div>
                                            </div>

                                        </div>

                                        <?php $i++;
                                                        if ($i != 0 && $i % 2 == 0) { ?>
                                        </div>
                                        <!--/.row-->
                                        <div class="clearfix"></div>

                                    <?php } ?>

                            <?php
                                        endwhile;
                                    }
                                    wp_reset_query();
                                    ?>



                        </div>


                    </div>

                <?php endif; ?>
                <div class="page-section-ptb grey-bg blogs_for_couples animated log_couples fadeInUp flex-container">

                    <div class="container">
                        <div class="row justify-content-center mb-5 sm-mb-2">
                            <div class="col-md-10 text-center">
                                <h2 style="text-shadow: 3px 3px white;width: 100%; text-align: center;">Blogs For Couples</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container my-container">
                        <?php
                            $args = array(
                                'post_type' => 'couple_blog',
                                'post_status' => 'publish',
                                'posts_per_page' => 4
                            );

                            $my_query = null;
                            $my_query = new WP_Query($args);

                            if ($my_query->have_posts()) {

                                $i = 0;
                                while ($my_query->have_posts()) : $my_query->the_post();

                                    // modified to work with 3 columns
                                    // output an open <div>
                                    if ($i % 2 == 0) { ?>
                                    <div class="row">
                                    <?php } ?>

                                    <div style="margin: 10px 0;" class="col-md-6 outer_box">
                                        <div class="gradient-border" id="box">
                                            <div class="my-inner">
                                                <div class="the_title_of_blog">
                                                    <h1 class="the_title_of_blog"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo wp_trim_words(get_the_title(), 3, '...'); ?></a></h1>
                                                </div>
                                                <div class="front_end_blog_image" style="float:left"><?php echo the_post_thumbnail( array( 500, 500 ) ); ?>
                                                </div>
                                                <div class="blog_page_content animated flash"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></div>
                                                <div class="source_url"><?php echo mb_strimwidth(carbon_get_the_post_meta('external_url'), 0, 50, '...'); ?></div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <?php $i++;
                                                if ($i != 0 && $i % 2 == 0) { ?>
                                    </div>
                                    <!--/.row-->
                                    <div class="clearfix"></div>

                                <?php } ?>

                        <?php
                                endwhile;
                            }
                            wp_reset_query();
                            ?>



                    </div>


                </div>
            </div>
        <?php } else { ?>
            <div class="container" style="text-align: center; ">
            <h2 style="color: black" class="title divider mb-3 text-shadow my_blogs">Blog-ling the Mind</h2>

            <div class="pl_login">Please login</div>
        </div>
            <div class="not_logged_in_blog row log-row">
            
                    <div class="col-xl-4 log-col">
                        <div class="log_boys">
                        <h2 style="text-shadow: 3px 3px #f73af9;width: 100%; text-align: center;">Blogs for Men</h2>
                        
                            <div class="inner_content_blog ">
                                <div style="margin: 10px 0;" class="outer_box">
                                    <div class="gradient-border" id="not_logged_in_box">
                                        <div class="my-inner">
                                            <img class="front_end_blog_image" src="<?php echo get_template_directory_uri() . '/assets/images/cars_front_page.jpg' ?>" alt="thumbnail">

                                            <div class="blog_page_content animated fadeIn">Subscribe to weblogs written by men and women who speak To Men Only as they offer their views on the changing Male dynamics in today’s American society. What are the ‘NewNorms’ in dating? How has the MeToo movement changed social relationships for Men?  What’s still appropriate and what’s a NoFlyZone in the workplace? When a woman dresses or behaves in a certain way, what does she really mean? What do women “think” that men need to know and understand? 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>
                        
                    </div>
                    <div class="col-xl-4 log-col">
                        <div class="log_couples">
                        <h2 style="text-shadow: 3px 3px white;width: 100%; text-align: center;">Blogs for Couples</h2>
                        

                            <div class="inner_content_blog ">
                                <div style="margin: 10px 0;" class="outer_box">
                                    <div class="gradient-border" id="not_logged_in_box">
                                        <div class="my-inner couples_women">
                                            <img class="front_end_blog_image" src="<?php echo get_template_directory_uri() . '/assets/images/couples_front_page.jpg' ?>" alt="thumbnail">
                                            <div class="blog_page_content animated fadeIn">Want to know more about the Now issues in relationships?  What makes us tick? What keeps us connected? What drives us apart?  How can we identify our natural qualities that someone else might find attractive?  How do we identify qualities in ourselves we think are great but drive others crazy?  What do we need to do to keep from hurting our partners as we develop a relationship?  What’s up with dating only one person at a time? Is the single-person relationship dying?  Hook up to weblogs that interest you and Tune in to those that challenge you! </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        
                    </div>
                    <div class="col-xl-4 log-col">
                        <div class="log_girls">
                        <h2 style="text-shadow: 3px 3px rgb(38, 168, 254);width: 100%; text-align: center;">Blogs for Women</h2>
                        

                            <div class="inner_content_blog ">
                                <div style="margin: 10px 0;" class="outer_box">
                                    <div class="gradient-border" id="not_logged_in_box">
                                        <div class="my-inner couples_women">
                                            <img class="front_end_blog_image" src="<?php echo get_template_directory_uri() . '/assets/images/girls_front_page.jpg' ?>" alt="thumbnail">
                                            <div class="blog_page_content animated fadeIn">Professional women and men speak To Women Only about the role women play in the rapidly changing American society. What are the ‘NewNorms’ in dating? What effect has the MeToo movement had on American society? What’s an appropriate workplace relationship? What should you expect when you dress or behave a certain way? Is “The Future Female”, or is the Glass Ceiling as unbreakable as ever? What do women need to understand about men? What’s with men collaborating with one another while women feel a need to compete? And how can women break out of that self-destructive chain?</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>
                       

                    </div>


        </div>
        </div>
            </div>
        <?php } ?>
</section>

<script>
    function loadChat() {

        $.ajax({
            url: '<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=getChat' ?>',
            dataType: 'json',
            success: function(response) {
                //console.log(response[0]['user']);
                $.each(response, function() {
                    for (var i = 0; i < response.length; i++) {
                        if (response[i]['reciever'] == '<?php echo get_user_meta($user_ID, 'nickname')[0] ?>' && response[i]['status'] == 1) {
                            console.log(response[i]['status'])
                            // $('.my_girls').text('You have nes message')
                            if (!$('.my_girls').children().hasClass('bell')) {
                                $('.my_girls').append('<span class="bell fa fa-bell"></span>')
                            }
                        } else {
                            $('.fa-bell').remove()
                        }
                    }
                });
            },
            error: function(req, status, err) {
                console.log('Something went wrong', status, err);
            }
        });
    }
    setInterval(function() {
        loadChat();
    }, 2000);
</script>
</main>
<?php
get_footer();
