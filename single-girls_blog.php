<?php

/**
 * Template Name: girls_blog
 */
get_header();


while (have_posts()) :
    the_post();
    ?>
    <div class="container">
        <div class="row blog_page">

            <div class="the_title_of_blog">
                <h1 [href]="<?php echo get_permalink($post->ID); ?>" class="the_title_of_blog"><?php echo get_the_title(); ?></h1>
            </div>
            <div class="thumb" style="float:left"><?php echo get_the_post_thumbnail(); ?></div>
            <div class="blog_page_content" style="float:left"><?php echo get_the_content(); ?></div>

        <?php


            $user_id = get_current_user_id();
            $comments = get_comments(array(
                'post_id' => $post->ID
            ));
            echo '<div class="leave_a_comment">Discussion</div>';
            foreach ($comments as $comment) {

                echo '<div class="row comments_pack"><div class"comment"><div class="author_comment">' . $comment->comment_author . '</div><br><div class="comment_content">' . $comment->comment_content . '</div></div></div>';
                echo '<br>';
            }
            echo '<div class"container comment_form">' . comment_form($comments) . '</div>';
        endwhile;
        wp_reset_query();
        ?>
        </div>
    </div>
    </div>
    </div>
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
    <?php
    get_footer();
    ?>