<?php

/**
 * Template Name: Couple Blog
 */
get_header();


while (have_posts()) :
    the_post();
    ?>
    <div class="container">
        <div class="row blog_page">


            <h1 class="the_title_of_blog"><?php echo get_the_title(); ?></h1><br>

            <div class="thumb" style="float:left; margin-bottom:20px;"><?php echo get_the_post_thumbnail(); ?></div>
            <div class="content_in_blog" style="float:left"><?php echo get_the_content(); ?></div>
            <div><p>Source: </p><?php echo carbon_get_the_post_meta('external_url') ?></div>
        <?php


            $user_id = get_current_user_id();
            $args = array(
                'title_reply' => 'Leave a comment',
            );
            $comments = get_comments(array(
                'post_id' => $post->ID,
            ));

            echo '<div class="leave_a_comment">Discussion</div>';
            foreach ($comments as $comment) {

                echo '<div class="row comments_pack"><div class"comment"><div class="author_comment">' . $comment->comment_author . '</div><br><div class="comment_content">' . $comment->comment_content . '</div></div></div>';
                echo '<br>';
            }
            if (pmpro_hasMembershipLevel('Gold') || pmpro_hasMembershipLevel('Private') || pmpro_hasMembershipLevel('Trial')) {
                echo '<div class"container comment_form">' . comment_form($args) . '</div>';
            } else {
                echo '<div class="leave_comment">Only members can leave a comment. <a href="' . get_site_url(null, '/membership-account/membership-levels/', null) . '"class="bec_member">Become a member!</a></div>';
            }
        endwhile;
        wp_reset_query();
        ?>
        </div>
    </div>
    </div>
    </div>
    <?php
    get_footer();
    ?>