<?php

/*
Template Name: Private Photo Gallery
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
    
    $html .= '<div class="col-md-12 align-items-center">';
    //echo wp_get_attachment_image_src($imgs[0]);
    $html .= ' <div class="grid-container">';

    foreach ($imgs as $img) {
        $src_thumb = wp_get_attachment_image_src($img);
        $src_full = wp_get_attachment_image_src($img, 'full');

        if (get_post_mime_type($img) == 'image/jpeg' || get_post_mime_type($img) == 'image/gif' || get_post_mime_type($img) == 'image/png') {
            if (carbon_get_post_meta($img, 'privat_image') == 'private') {
                $html .= '
               
                    <div class="grid-item">
                    
                        <input type="button" name="checkbox_image" style="cursor: pointer;" class="unset_private"  privatr="' . $img . '" value="Unset Private" /><br />

                        <a class="example-image-link" href="' . $src_full[0] . '" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                            <img class="example-image" src="' . $src_thumb[0] . '" alt="" />
                        </a>
                    </div>';
            }
        }
    }

    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div></div>';

    return $html;
}

echo carbon_get_the_post_meta( get_current_user_id(), 'privat_image' );
?>
<form class="pci_maz" action="<?php echo get_stylesheet_directory_uri() ?>/inc/unset_private.php" method="POST">
<input type="hidden" class="delete_vid" name="delete_vid">
<input type="hidden" class="esim_incha" name="unset_private">
<div class="form-group sm-mb-0" style="display: flex;justify-content: flex-end;margin: 0px; position: fixed; top: 15%; right: 22px;"><button style="height: 60px;" class="button btn-lg btn-theme full-rounded animated right-icn">Save</button></div>

</form>

<?php
echo display_images_from_media_library();
get_footer();
