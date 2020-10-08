<?php

/*
 Template Name: Private Video Arcade
 */

get_header();
function get_images_from_media_library()
{
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => array('image/jpeg', 'image/png', 'video/mp4', 'image/gif'),
        'post_status' => 'inherit',
        'posts_per_page' => 500,
        'author' => get_current_user_id(),
        'orderby' => 'title',

    );
    $query_images = new WP_Query($args);

    $images = array();

    foreach ($query_images->posts as $image) {
        $images[] = $image->ID;
    }
    // var_dump($images);
    return $images;
}

function display_images_from_media_library()
{

    $imgs = get_images_from_media_library();
    $html = '<div class="container">
    <div class="row">';
    




    
    foreach ($imgs as $video) {
        if (get_post_mime_type($video) == 'video/mp4' && $imgs != 718) {
            $url = wp_get_attachment_url($video);
            if (carbon_get_post_meta($video, 'private_video') != '') {
               
             
            
                $html .= '<div class="grid-item video_arcade_grid"><div class="all_videos"><div type="button" class="video_button arcade_video_private">Set as private</div><div type="button" class="delete_video arcade_video_delete">Delete video</div><div type="button" class="unset_video_button arcade_video_unset">Unset private</div><video  width="320" height="240" controls><source src="'. $url .'" type="video/mp4"></video></div></div>';
               
            }
            
        }
    }




    $html .= '</div></div>';





    return $html;
}

echo display_images_from_media_library();
get_footer();
