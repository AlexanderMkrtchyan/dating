<?php

/*
Template Name: Change profile
*/

get_header();

?>

<section style="display: block; height: 50%">
    <div class="carousel-item bg-overlay-red"
        style="display:flex; background: url(<?php echo get_template_directory_uri() . '/assets/images/profile.jpg' ?>) no-repeat 0 0; background-size: cover;">
        <div class="slider-content">
            <div class="container">
                <div class="row carousel-caption align-items-center">
                    <div class="col-md-12 text-left">
                        <div class="slider-1">
                            <h1 class="animated7 text-white"><?php echo get_the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
global $user_ID;

// если пользователь не авторизован, отправляем его на страницу входа
if (!$user_ID) {
    wp_safe_redirect('dating');
    exit;
} else {
    $userdata = get_user_by('id', $user_ID);
}


?>

<div class="profile_image">
    <img class="img-fluidd img-fluid w-100" src="<?php if ($userdata->klri_glox == '') {
                                                        echo get_template_directory_uri() . '/assets/images/no_person.png';
                                                    } else {
                                                        echo wp_get_attachment_image_src( $userdata->klri_glox, 'thumbnail',  true )[0];
                                                    } ?>" alt="Profile Image" />
    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
</div>















<section class="profile_images">
    <div class="container">
    </div>
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    </button>
                </div>
                <div class="modal-body">
                    <p>.............</p>
                </div>
                <div class="modal-footer">
                    ..........
                </div>
            </div>
        </div>
    </div>
</section>


<section class="profile_images">
    <div class="container">


        <table class="form-table">


            <?php echo display_images_from_media_library(); ?>
            <!-- Uploading image to site -->
        </table>
    </div>
</section>

<?php


// NO PERSON URL->POST ID
$person_link = get_template_directory_uri() . '/assets/images/no_person.png';
$no_person = attachment_url_to_postid($person_link);
echo get_the_post_thumbnail_url( $no_person );
function display_images_from_media_library()
{

    $imgs = get_images_from_media_library();
    $html .= '<div class="container"><div class="row"><div class="col-md-6 col-xs-12">';
    $html .= '<div class="save_btn" style="display: none;">Click on save button</div>';
    $html .= '<div type="button" class="video_button ">Set as private</div>';
    $html .= '<div type="button" class="delete_video">Delete video</div>';
    $html .= '<div type="button" class="unset_video_button">Unset private</div>';
    $html .= '<div style="display:none; float: left" class="html5gallery" data-skin="horizontal" data-width="413" data-height="136">';

    foreach ($imgs as $video) {
        if (get_post_mime_type($video) == 'video/mp4') {
           
            $url = wp_get_attachment_url($video);
            $html .= '<a id="' . $video . '" href="' . $url . '"><img src="' . get_template_directory_uri() . '/assets/images/profile_background.jpg' . '" alt="This is my demo video"></a>';
        }
    }

    $html .= '   </div></div><div class="col-md-6 col-xs-12">';
    $html .= '<div class="flex_links"><div class="priv_image_link"><a style="color: black;" class="private_grid_images_link" target="_blank"  href="' . get_permalink(get_page_by_path("private-photo-gallery")) . '"><img class="private_link_images" src="' . get_template_directory_uri(  ) . '/assets/images/timeline/old_camera.png" alt="old camera"/>Private Photo Gallery<i class="fa fa-play" aria-hidden="true"></i></a></div><div class="priv_video_link"><a style="color:black;" class="private_grid_images_link" target="_blank"  href="' . get_permalink(get_page_by_path("private-video-arcade")) . '"><img class="private_link_images" src="' . get_template_directory_uri(  ) . '/assets/images/timeline/film_canister.png" alt="old cinema"/>Private Video Arcade<i class="fa fa-play" aria-hidden="true"></i></a></div></div></div></div></div></div>';
    //echo wp_get_attachment_image_src($imgs[0]);
    $html .= '<div class="gallery">';
    $html .= '<div class="public_gallery">PUBLIC PHOTO GALLERY</div>';
    $z = 48;

    foreach ($imgs as $img) {
        $src_thumb = wp_get_attachment_image_src($img);
        $src_full = wp_get_attachment_image_src($img, 'full');
        if (get_post_mime_type($img) == 'image/jpeg' || get_post_mime_type($img) == 'image/gif' || get_post_mime_type($img) == 'image/png') {
            if (carbon_get_post_meta($img, 'privat_image') != 'private') {
                    if($z % 6 == 0 && $z > 5){
                        $html .= '<div class="lenta">';
                        }
                        $html .= '    
                        <div class="lenta-item">
                        <input type="button" name="checkbox_image" style="cursor: pointer;"  class="image_checkbox" placeholder="Name" privatr="' . $img . '" value="Set as private" />
                            <div class="lenta-item-inner"  style="background-image: url(' . $src_thumb[0] . ')"></div><div image-id="'. $img .'" class="prevent_delete">Right click to DELETE</div>
                        </div>'; 
                        $z--;
            }
        }
        if($z % 6 == 0 && $z > 3){
            $html .= '</div>';
            } 
            
            }
            
           
            
            $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div></div>';

    return $html;
}


/*
<form class="upload_form" method="post" enctype="multipart/form-data" name="front_end_upload">
                        <input id="uploadfiles" type="file" name="kv_multiple_attachments[]" multiple="multiple">  
                                 
                    <pre id="infos"></pre>
                    <input class="button removable btn-lg btn-theme full-rounded animated right-icn" type="submit" name="Upload">
                </form>
*/
?>
<section class="upload_img">
<div class="container">
    <div class="col-md-12">
        <div class="upload_images_form">
            <form class="upload_form" method="post" enctype="multipart/form-data" name="front_end_upload">
                <p>Drag and drop photos here</p>
                <input id="uploadfiles" type="file" name="kv_multiple_attachments[]" multiple="multiple">
                <button type="submit">Upload</button>

            </form>

        </div>
        <div class="show_images"></div>
    </div>

</div>

</section>




<div class="pci_maz">

        <div class="container">
            <div class="profile_border row">
                <label id="search_label" for="about_me">Tell us about yourself in a short bio:</label>
                <textarea name="about_me" type="text" maxlength="500"
                    placeholder="About me"><?php echo $userdata->about_me ?></textarea>
            </div>
        </div>
        <div class="container">
            <div class="profile_border row">
                <label id="search_label" for="looking_for_in">What are you looking for in a <?php
									if(get_user_meta($user_ID, 'gender', true) == "Male"){
										echo 'girl:';
									}else{
										echo 'man:';
									}
									?></label>
                <textarea name="looking_for_in" type="text" maxlength="500"
                    placeholder="Looking for..."><?php echo get_user_meta($user_ID, 'looking_for_in', true) ?></textarea>
            </div>
        </div>
        <div class="container">
            <p class="prof_sect">WYA?</p>
            <div class="profile_border row">
                <div class="col-md-6 col-xs-12">
                    <label id="search_label">State:</label>
                    <input type="text" class="state_name" name="state" placeholder="Your state"
                        value="<?php echo $userdata->state ?>"><br />

                    <div class="selecting" style="display: none;">
                        <?php $selected =  get_user_meta($user_ID, 'state', true); ?>
                        <label id="search_label" for="state">State</label>
                        <select class="state_ip">
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <label id="search_label">City:</label>
                    <input type="text" class="city_name" name="city" placeholder="Your city"
                        value="<?php echo $userdata->city ?>"><br />
                </div>
            </div>
        </div>
        <div class=" container">
            <p class="prof_sect">Your Lifestyle</p>
            <div class="profile_border row">
                <div class="col-md-6 col-xs-12">

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'smoking', true); ?>
                        <label id="search_label" for="smoking">Smoking</label>
                        <select name="smoking" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Occasionally"
                                <?php echo ($selected == "Occasionally") ?  'selected="selected"' : '' ?>>Occasionally
                            </option>
                            <option value="Regularly"
                                <?php echo ($selected == "Regularly") ?  'selected="selected"' : '' ?>>Regularly
                            </option>
                            <option value="No" <?php echo ($selected == "No") ?  'selected="selected"' : '' ?>>No
                            </option>
                        </select>
                    </div>
                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'gender', true); ?>
                        <label id="search_label" for="gender">gender</label>
                        <select name="gender" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Male" <?php echo ($selected == "Male") ?  'selected="selected"' : '' ?>>Male
                            </option>
                            <option value="Female" <?php echo ($selected == "Female") ?  'selected="selected"' : '' ?>>
                                Female</option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'relationship', true); ?>
                        <label id="search_label" for="relationship">Relationship status:</label>
                        <select name="relationship" id="user_select"><br />

                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>

                            <option value="Serious relationships"
                                <?php echo ($selected == "Serious relationships") ?  'selected="selected"' : '' ?>>
                                Serious
                                relationships</option>
                            <option value="Single" <?php echo ($selected == "Single") ?  'selected="selected"' : '' ?>>
                                Single</option>
                            <option value="Separated"
                                <?php echo ($selected == "Separated") ?  'selected="selected"' : '' ?>>Separated
                            </option>
                            <option value="Divorced"
                                <?php echo ($selected == "Divorced") ?  'selected="selected"' : '' ?>>
                                Divorced</option>
                            <option value="Widower"
                                <?php echo ($selected == "Widower") ?  'selected="selected"' : '' ?>>
                                Widower</option>
                            <option value="Married"
                                <?php echo ($selected == "Married") ?  'selected="selected"' : '' ?>>
                                Married</option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'user_tatoo', true); ?>
                        <label id="search_label" for="user_tatoo">Have a tattoo?</label>
                        <select name="user_tatoo" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="None" <?php echo ($selected == "None") ?  'selected="selected"' : '' ?>>
                                Nonene
                            </option>
                            <option value="Many" <?php echo ($selected == "Many") ?  'selected="selected"' : '' ?>>Many
                            </option>
                            <option value="Covered"
                                <?php echo ($selected == "Covered") ?  'selected="selected"' : '' ?>>
                                Covered</option>
                            <option value="A few" <?php echo ($selected == "A few") ?  'selected="selected"' : '' ?>>A
                                few
                            </option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'education', true); ?>
                        <label id="search_label" for="education">Education</label>
                        <select name="education" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="I think so"
                                <?php echo ($selected == "I think so") ?  'selected="selected"' : '' ?>>I think so
                            </option>
                            <option value="High School"
                                <?php echo ($selected == "High School") ?  'selected="selected"' : '' ?>>High School
                            </option>
                            <option value="College"
                                <?php echo ($selected == "College") ?  'selected="selected"' : '' ?>>
                                College</option>
                            <option value="Graduate degree"
                                <?php echo ($selected == "Graduate degree") ?  'selected="selected"' : '' ?>>Graduate
                                degree
                            </option>
                            <option value="Post graduate"
                                <?php echo ($selected == "Post graduate") ?  'selected="selected"' : '' ?>>Post graduate
                            </option>
                        </select>
                    </div>

                </div>



                <div class="col-md-6 col-xs-12">
                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'drinking', true); ?>
                        <label id="search_label" for="drinking">Drinking</label>
                        <select name="drinking" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Socially"
                                <?php echo ($selected == "Socially") ?  'selected="selected"' : '' ?>>
                                Socially</option>
                            <option value="Regularly"
                                <?php echo ($selected == "Regularly") ?  'selected="selected"' : '' ?>>Regularly
                            </option>
                            <option value="No" <?php echo ($selected == "No") ?  'selected="selected"' : '' ?>>No
                            </option>
                            <option value="Sober" <?php echo ($selected == "Sober") ?  'selected="selected"' : '' ?>>
                                Sober
                            </option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'income', true); ?>
                        <label id="search_label" for="income">Annual income</label>
                        <select name="income" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Less than $20,000"
                                <?php echo ($selected == "Less than $20,000") ?  'selected="selected"' : '' ?>>Less than
                                $20,000</option>
                            <option value="$20,000-$30,000"
                                <?php echo ($selected == "$20,000-$30,000") ?  'selected="selected"' : '' ?>>
                                $20,000-$30,000
                            </option>
                            <option value="$50,000-$75,000"
                                <?php echo ($selected == "$50,000-$75,000") ?  'selected="selected"' : '' ?>>
                                $30,000-$50,000
                            </option>
                            <option value="$50,000-$75,000"
                                <?php echo ($selected == "$50,000-$75,000") ?  'selected="selected"' : '' ?>>
                                $50,000-$75,000
                            </option>
                            <option value="$75,000-$100,000"
                                <?php echo ($selected == "$75,000-$100,000") ?  'selected="selected"' : '' ?>>
                                $75,000-$100,000</option>
                            <option value="$100,000 or more"
                                <?php echo ($selected == "$100,000 or more") ?  'selected="selected"' : '' ?>>$100,000
                                or
                                more</option>
                            <option value="I'd rather not say"
                                <?php echo ($selected == "I'd rather not say") ?  'selected="selected"' : '' ?>>I'd
                                rather
                                not say</option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'piercings', true); ?>
                        <label id="search_label" for="piercings">Piercings</label>
                        <select name="piercings" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="None" <?php echo ($selected == "None") ?  'selected="selected"' : '' ?>>None
                            </option>
                            <option value="Many" <?php echo ($selected == "Many") ?  'selected="selected"' : '' ?>>Many
                            </option>
                            <option value="Covered"
                                <?php echo ($selected == "Covered") ?  'selected="selected"' : '' ?>>
                                Covered</option>
                            <option value="A few" <?php echo ($selected == "A few") ?  'selected="selected"' : '' ?>>A
                                few
                            </option>
                            <option value="Just ears"
                                <?php echo ($selected == "Just ears") ?  'selected="selected"' : '' ?>>Just ears
                            </option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'looking_for', true); ?>
                        <label id="search_label" for="looking_for">Looking for:</label>
                        <select name="looking_for" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="NSA" <?php echo ($selected == "NSA") ?  'selected="selected"' : '' ?>>NSA
                            </option>
                            <option value="Serious"
                                <?php echo ($selected == "Serious") ?  'selected="selected"' : '' ?>>
                                Serious</option>
                            <option value="Long-term"
                                <?php echo ($selected == "Long-term") ?  'selected="selected"' : '' ?>>Long-term
                            </option>
                            <option value="Marriage"
                                <?php echo ($selected == "Marriage") ?  'selected="selected"' : '' ?>>
                                Marriage</option>
                            <option value="See where it leads"
                                <?php echo ($selected == "See where it leads") ?  'selected="selected"' : '' ?>>See
                                where it
                                leads</option>
                            <option value="Casual" <?php echo ($selected == "Casual") ?  'selected="selected"' : '' ?>>
                                Casual</option>
                            <option value="Dating" <?php echo ($selected == "Dating") ?  'selected="selected"' : '' ?>>
                                Dating</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <p class="prof_sect ">Physical?</p>
            <div class="row profile_border">
                <div class="col-md-6 col-xs-12">
                    <label id="search_label" for="puc">Hight:(feet and inches)</label>
                    <input type="text" name="puc" placeholder="Height" value="<?php echo $userdata->puc ?>" /><br />

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'size', true); ?>
                        <label id="search_label" for="size">Body type:</label>
                        <select name="size" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Fit" <?php echo ($selected == "Fit") ?  'selected="selected"' : '' ?>>Fit
                            </option>
                            <option value="Slim" <?php echo ($selected == "Slim") ?  'selected="selected"' : '' ?>>Slim
                            </option>
                            <option value="Few extra pounds"
                                <?php echo ($selected == "Few extra pounds") ?  'selected="selected"' : '' ?>>Few extra
                                pounds</option>
                            <option value="Average"
                                <?php echo ($selected == "Average") ?  'selected="selected"' : '' ?>>
                                Average</option>
                            <option value="Heavy" <?php echo ($selected == "Heavy") ?  'selected="selected"' : '' ?>>
                                Heavy
                            </option>
                            <option value="Muscular"
                                <?php echo ($selected == "Muscular") ?  'selected="selected"' : '' ?>>
                                Muscular</option>
                        </select>
                    </div>

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'eye_color', true); ?>
                        <label id="search_label" for="eye_color">Eye color</label>
                        <select name="eye_color" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Black" <?php echo ($selected == "Black") ?  'selected="selected"' : '' ?>>
                                Black
                            </option>
                            <option value="Brown" <?php echo ($selected == "Brown") ?  'selected="selected"' : '' ?>>
                                Brown
                            </option>
                            <option value="Blue" <?php echo ($selected == "Blue") ?  'selected="selected"' : '' ?>>Blue
                            </option>
                            <option value="Gray" <?php echo ($selected == "Gray") ?  'selected="selected"' : '' ?>>Gray
                            </option>
                            <option value="Green" <?php echo ($selected == "Green") ?  'selected="selected"' : '' ?>>
                                Green
                            </option>
                            <option value="Hazel" <?php echo ($selected == "Hazel") ?  'selected="selected"' : '' ?>>
                                Hazel
                            </option>
                            <option value="Colored Contacts"
                                <?php echo ($selected == "Colored Contacts") ?  'selected="selected"' : '' ?>>Colored
                                Contacts</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-6 col-xs-12">

                    <label id="search_label" for="age">Age:</label>
                    <input type="text" id="age" name="age" placeholder="Age"
                        value="<?php echo $userdata->age ?>" /><br />

                    <div class="selecting">
                        <?php $selected =  get_user_meta($user_ID, 'hair_color', true); ?>
                        <label id="search_label" for="hair_color">Hair color</label>
                        <select name="hair_color" id="user_select"><br />
                            <option value=""><?php echo $selected   ?   $selected  : '' ?></option>
                            <option value="" <?php echo ($selected == "") ?  $selected : '' ?>></option>
                            <option value="Auburn" <?php echo ($selected == "Auburn") ?  'selected="selected"' : '' ?>>
                                Auburn/Red</option>
                            <option value="Black" <?php echo ($selected == "Black") ?  'selected="selected"' : '' ?>>
                                Black
                            </option>
                            <option value="Dark Brown"
                                <?php echo ($selected == "Dark Brown") ?  'selected="selected"' : '' ?>>Dark Brown
                            </option>
                            <option value="Light Blonde"
                                <?php echo ($selected == "Light Blonde") ?  'selected="selected"' : '' ?>>Light Blonde
                            </option>
                            <option value="Gray" <?php echo ($selected == "Gray") ?  'selected="selected"' : '' ?>>Gray
                            </option>
                            <option value="Bald" <?php echo ($selected == "Bald") ?  'selected="selected"' : '' ?>>Bald
                            </option>
                            <option value="Light Brown"
                                <?php echo ($selected == "Light_Brown") ?  'selected="selected"' : '' ?>>Light Brown
                            </option>
                            <option value="Dark Blond"
                                <?php echo ($selected == "Dark Blond") ?  'selected="selected"' : '' ?>>Dark Blond
                            </option>
                            <option value="Salt&Pepper"
                                <?php echo ($selected == "Salt&Pepper") ?  'selected="selected"' : '' ?>>Salt&Pepper
                            </option>
                            <option value="Contrating Streaks"
                                <?php echo ($selected == "Contrating Streaks") ?  'selected="selected"' : '' ?>>
                                Contrating
                                Streaks</option>
                        </select>
                    </div>

                    <label id="search_label" for="ethnicity">Ethnicity:</label>
                    <input type="text" name="ethnicity" placeholder="ethnicity"
                        value="<?php echo $userdata->ethnicity ?>" /><br />
                </div>
            </div>
            <hr class="user_change_hr">
        </div>










        <input type="hidden" class="delete_vid" name="delete_vid">
        <input type="hidden" class="unset_video_click" name="unset_video_click">
        <input type="hidden" class="video_click" name="video_click">
        <input type="hidden" class="es_inchae" name="image_checkbox">
        <input type="hidden" class="esim_incha" name="unset_private">
        <input type="hidden" class="profile_image" name="profile_image">
        <input type="hidden" class="delete_image" name="delete_image">

        <div class=" container">
            <div class="profile_border row">
                <div class="col-md-6 col-xs-12">
                    <label>First Name:</label><br />
                    <input type="text" name="first_name" placeholder="Name"
                        value="<?php echo $userdata->first_name ?>" /><br />
                    <label>Last Name:</label><br />
                    <input type="text" name="last_name" placeholder="Last Name"
                        value="<?php echo $userdata->last_name ?>" /><br />
                    <label>Email:</label><br />
                    <input type="email" name="email" placeholder="Email"
                        value="<?php echo $userdata->user_email ?>" /><br />
                    <input type="hidden" id="klri_glox" name="klri_glox">
                </div>
                <div class="col-md-6 col-xs-12">
                    <label>Current password</label><br />
                    <input type="password" name="pwd1" placeholder="current password" /><br />
                    <label for="pwd2">New password</label><br />
                    <input type="password" name="pwd2" placeholder="new password" /><br />
                    <label for="pwd3">Confirm new password</label><br />
                    <input type="password" name="pwd3" placeholder="confirm password" /><br />



                </div>
            </div>
        </div>
    

    <div class="form-group sm-mb-0 save_button_after_preview" style="position: relative;justify-content: flex-end;margin: 0px;  top: 15%; right: 22px;">
    
    <button
            style="position: fixed;height: 60px; right:0; bottom: 55px;"
            class="button btn-lg btn-theme full-rounded animated right-icn">
            <div class="saved_after_click">Saved</div>Save
    </button>
    </div>
            

</div>


<button class="kayfavat animated fadeInUp"><a href="#openModal"></a>Preview</button>





<?php


if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ($_FILES) {
        $files = $_FILES["kv_multiple_attachments"];
        foreach ($files['name'] as $key => $value) {
            if ($files['name'][$key]) {

                $file = array(
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'size' => $files['size'][$key],
                );

                $_FILES = array("kv_multiple_attachments" => $file); 
                foreach ($_FILES as $file => $array) {
                    $newupload = kv_handle_attachment($file, $pid);
                }
            }
        }
    }
}

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









//notifications
if (isset($_GET['status'])) :
    switch ($_GET['status']):
        case 'ok': {
                echo '<div class="ok" id="ok_status" style="padding: 14px;text-align: center;background-color: aquamarine;margin: 0px;">The data saved.</div>';
                break;
            }
        case 'exist': {
                echo '<div class="error">The user with this email already exist.</div>';
                break;
            }
        case 'short': {
                echo '<div class="error">Password is too short.</div>';
                break;
            }
        case 'mismatch': {
                echo '<div class="error">Passwordes doesn\'t match.</div>';
                break;
            }
        case 'wrong': {
                echo '<div class="error">Old password is wrong.</div>';
                break;
            }
        case 'required': {
                echo '<div class="error">Please fill all required fields.</div>';
                break;
            }
    endswitch;
endif;





get_footer();
?>