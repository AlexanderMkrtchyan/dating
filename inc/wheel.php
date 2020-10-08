<?php

/**
 * Template Name: Wheel
 */
get_header();
?>
<section class="wheels">
    <div class="vertical-align-container">
        <div class="vertical-align-block">
            <div class="container">
                <div class="row justify-content-center mb-2 sm-mb-0">
                    <div class="col-md-8 text-center">
                        <h2 style="border-bottom: none;" class="title divider text-shadow">Hot Profiles</h2>
                        <b class="hr anim"></b>
                    </div>
                    <div style="float: right;" class="wheels text-center">
                        <a href="#ex2" rel="modal:open">
                            <img class="globe" src="<?php echo get_template_directory_uri() . '/assets/images/timeline/search.png' ?>" alt="" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="experiment">
                <div id="contentContainer" class="trans3d">
                    <div id="carouselContainer" class="trans3d">

                        <?php
                        if (is_user_logged_in()) {
                            $blogusers = get_users( array( 'fields' => array( 'ID' ), 'meta_key'=> 'gender', 'orderby' => 'ID') );
                            // $blogusers = get_users(array('fields' => array('ID')));
                            $i = 0;

                            // Array of stdClass objects.
                            foreach ($blogusers as $user) {

                                $usersin = get_user_meta($user->ID);
                                $profile_id = get_user_meta($user->ID, 'profile_image')[0];
                                $image_src = wp_get_attachment_image_src( $profile_id,  'thumbnail', true )[0];
                                $image_id = attachment_url_to_postid($usersin['profile_image'][0]);
                                $klir = get_template_directory_uri() . '/assets/images/no_person.png';

                                //$image_src =  $usersin['profile_image'][0];
                                
                                ?>
                                <figure class="carouselItem trans3d">
                                    <div class="carouselItemInner trans3d">
                                        <div class="item click_item"> <a target="_blank" href="<?php echo get_home_url() . '/profile/?w1=' . $user->ID ?>" data-id='<?php echo $user->ID ?>' class="profile-item">
                                                <div id="<?php echo $usersin['nickname'][0] ?>" class="profile-image clearfix"><img class="img-fluid w-100" src="<?php echo $image_src; ?>" alt="" /></div>
                                                <div class="profile-details text-center">
                                                    <h5 class="title"><?php echo $usersin['nickname'][0] ?></h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </figure>


                            <?php
                            $i++;
                            if($i > 50){
                            break;
                            }
                                }
                            } else {
                                //$male_name = ['Christopher', 'Jacob', 'Tyler', 'Brandon', 'Nicholas', 'Austin', 'Andrew', 'Daniel', 'Joseph', 'David', 'Zack', 'Jonathen', 'Matt', 'Zachary', 'Ryan', 'Christopher', 'Jacob', 'Tyler', 'Brandon', 'Nicholas', 'Austin', 'Andrew', 'Daniel', 'Joseph', 'David', 'Zack', 'Jonathen', 'Matt', 'Zachary', 'Ryan', 'Anthony'];
                                //$female_name = ['Emily', 'Madison', 'Hannah', 'Sarah', 'Alexis', 'Jessica', 'Taylor', 'Lauren', 'Alyssa', 'Brianna', 'Brittany', 'Samantha', 'Emma', 'Olivia', 'Isabella', 'Emily', 'Madison', 'Hannah', 'Sarah', 'Alexis', 'Jessica', 'Taylor', 'Lauren', 'Alyssa', 'Brianna', 'Brittany', 'Samantha', 'Emma', 'Olivia', 'Isabella'];
                                ?>
                            <figure class="carouselItem trans3d">
                                <div class="carouselItemInner trans3d">
                                    <div class="item click_item"> <a target="_blank" href="" data-id='male' class="profile-item">
                                            <div id="" class="profile-image clearfix"><img class="img-fluid w-100" src="http://dating/wp-content/uploads/2019/10/RecordRTC-201994-51su9nzmjzr-1.gif" alt="" /></div>
                                            <div class="profile-details text-center">
                                                <h5 class="title">Alex</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </figure>

                            <?php

                                for ($i = 0; $i < 30; $i++) {
                                    $url = site_url() . '/wp-content/uploads/2019/10/' . $i . '.jpg';
                                    $gif_url = 'http://dating.u0804230.cp.regruhosting.ru/wp-content/uploads/2019/11/gif_girl' . $i . '.gif';
                                        

                                    $thumbid = attachment_url_to_postid($url);

                                    if ($i % 2 == 0) {
                                        print_r($i);

                                        ?>
                                    <figure class="carouselItem trans3d">
                                        <div class="carouselItemInner trans3d">
                                            <div class="item click_item"> <a target="_blank" href="" data-id='male' class="profile-item">
                                                    <div id="" class="profile-image clearfix"><img class="img-fluid w-100" src="<?php echo wp_get_attachment_thumb_url($thumbid); ?>" alt="" /></div>
                                                    <div class="profile-details text-center">
                                                        <h5 class="title"><?php echo $male_name[$i]; ?></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </figure>
                                <?php
                                        } elseif ($i % 3 == 0 && $i < 26) {
                                            ?>
                                    <figure class="carouselItem trans3d">
                                        <div class="carouselItemInner trans3d">
                                            <div class="item click_item"> <a target="_blank" href="" data-id='female' class="profile-item">
                                                    <div id="" class="profile-image clearfix gif_girl_div"><img class="img-fluid w-100 gif_girl_image" src="<?php echo $gif_url; ?>" alt="" /></div>
                                                    <div class="profile-details text-center">
                                                        <h5 class="title"><?php echo $female_name[$i]; ?></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </figure>
                        <?php
                                }else{
                                    ?>
                                    <figure class="carouselItem trans3d">
                                        <div class="carouselItemInner trans3d">
                                            <div class="item click_item"> <a target="_blank" href="" data-id='female' class="profile-item">
                                                    <div id="" class="profile-image clearfix"><img class="img-fluid w-100" src="<?php echo wp_get_attachment_thumb_url($thumbid); ?>" alt="" /></div>
                                                    <div class="profile-details text-center">
                                                        <h5 class="title"><?php echo $female_name[$i]; ?></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </figure>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search form -->
    <div id="ex2" class="modal">
        <p>Are you looking for women to fulfill your fantasies</p>
        <form method="POST">
            <div>
                <label id="search_label" for="age_from">Age from</label>
                <select name="age_from" id="age_from">
                    <?php
                    for ($i = 18; $i < 70; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                </select>
            </div>
            <label id="search_label" for="age_to">Age to</label>
            <select name="age_to" id="age_from">
                <?php
                for ($i = 19; $i < 70; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                } ?>
            </select>
            <div>
                <label id="search_label" for="state">State</label>
                <select name="state">
                    <option value="Alabama">Alabama</option>
                    <option value="Alaska">Alaska</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Arizona">Arizona</option>
                    <option value="Arkansas">Arkansas</option>
                    <option value="California">California</option>
                    <option value="Connecticut">Connecticut</option>
                    <option value="Delaware">Delaware</option>
                    <option value="Florida">Florida</option>
                    <option value="Guam">Guam</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Idaho">Idaho</option>
                    <option value="Illinois">Illinois</option>
                    <option value="Indiana">Indiana</option>
                    <option value="Iowa">Iowa</option>
                    <option value="Kansas">Kansas</option>
                    <option value="Kentucky">Kentucky</option>
                    <option value="Louisiana">Louisiana</option>
                    <option value="Maine">Maine</option>
                    <option value="Maryland">Maryland</option>
                    <option value="Massachusetts">Massachusetts</option>
                    <option value="Michigan">Michigan</option>
                    <option value="Minnesota">Minnesota</option>
                    <option value="Mississippi">Mississippi</option>
                    <option value="Missouri">Missouri</option>
                    <option value="Montana">Montana</option>
                    <option value="Nebraska">Nebraska</option>
                    <option value="Nevada">Nevada</option>
                    <option value="New Hampshire">New Hampshire</option>
                    <option value="New Jersey">New Jersey</option>
                    <option value="New Mexico">New Mexico</option>
                    <option value="New York">New York</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="North Carolina">North Carolina</option>
                    <option value="North Dakota">North Dakota</option>
                    <option value="Ohio">Ohio</option>
                    <option value="Oklahoma">Oklahoma</option>
                    <option value="Oregon">Oregon</option>
                    <option value="Pennsylvania">Pennsylvania</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Rhode Island">Rhode Island</option>
                    <option value="South Carolina">South Carolina</option>
                    <option value="South Dakota">South Dakota</option>
                    <option value="Tennessee">Tennessee</option>
                    <option value="Texas">Texas</option>
                    <option value="US Virgin Islands">US Virgin Islands</option>
                    <option value="Utah">Utah</option>
                    <option value="Vermont">Vermont</option>
                    <option value="Virginia">Virginia</option>
                    <option value="Washington">Washington</option>
                    <option value="West Virginia">West Virginia</option>
                    <option value="Wisconsin">Wisconsin</option>
                    <option value="Wyoming">Wyoming</option>
                </select>
            </div>
            <div>
                <label id="search_label" for="status">Status</label>
                <select name="status"><br />
                    <option value="Serious relationships">Serious relationships</option>
                    <option value="Never married">Never married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                </select>
            </div>
            <div>
                <label id="search_label" for="inp" class="inp"></label>
                <input name="city" type="text" id="inp" placeholder="&nbsp;">
                <span class="label" style="padding-left: 3px;">City</span>
            </div>

            <button type="submit" class=" modal_button button btn-lg btn-theme full-rounded animated right-icn">Search</button>
        </form>
        

    </div>



    <?php
    if (isset($_POST['state'])  || isset($_POST['age_from']) || isset($_POST['age_to']) || isset($_POST['city'])) {
        ?>
        <div class="page-section-ptb profile-slider pb-3 sm-pb-6">
            <div class="container">
                <div class="row justify-content-center mb-2 sm-mb-0">
                    <div class="col-md-8 text-center">
                        <h2 class="title divider">Search result</h2>
                    </div>
                </div>





                <?php
                    $i = 0;
                    $blogusers = get_users(array(
                        'fields' => array('ID')
                    ));
                    if ($i % 2 == 0) {
                        ?>
                    <div class="container">
                        <div class="row">

                            <?php }
                                // Array of stdClass objects.
                                foreach ($blogusers as $user) {





                                    //var_dump(get_user_meta( $user->ID )['user_select']);
                                    $usersin = get_user_meta($user->ID);
                                    //var_dump($usersin);
                                    $image_id = attachment_url_to_postid($usersin['profile_image'][0]);
                                    $klir = get_template_directory_uri() . '/assets/images/no_person.png';
                                    $image_src =  wp_get_attachment_image_src($image_id);
                                    if (strtolower($_POST['state']) == strtolower($usersin['state'][0]) || strtolower($_POST['state']) == '' and strtolower($_POST['status']) == strtolower($usersin['status'][0]) || strtolower($_POST['status']) == '' and strtolower($_POST['city']) == strtolower($usersin['country'][0]) || strtolower($_POST['city']) == '' and strtolower($_POST['age_from']) < strtolower($usersin['age'][0]) || strtolower($_POST['age_from']) == '' and strtolower($_POST['age_to']) > strtolower($usersin['age'][0]) || strtolower($_POST['age_to']) == '') {

                                        ?>
                                <div class="col-md-6">
                                    <div class="my-inner">
                                        <a target="_blank" href="<?php echo get_home_url() . '/profile/?w1=' . $user->ID ?>" data-id='<?php echo $user->ID ?>' class="profile-item">
                                            <div class="profile-image clearfix"><img class="img-fluid w-100" src=" <?php
                                                                                                                                if ($image_src[0] == NULL) {
                                                                                                                                    echo $klir;
                                                                                                                                } else {
                                                                                                                                    echo $image_src[0];
                                                                                                                                }
                                                                                                                                ?>" alt="" />

                                                <div class="profile-details text-center">
                                                    <h5 class="title"><?php echo $usersin['nickname'][0] ?></h5>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                </div>

                            <?php

                                    }
                                }
                                $i++;
                                
                                if ($i != 0 && $i % 2 == 0) { ?>
                        </div>
                        <!--/.row-->
                    </div>
                    <div class="clearfix"></div>

                <?php }
                
                    ?>
            </div>
        <?php } ?>


        <!-- Search form -->
</section>
