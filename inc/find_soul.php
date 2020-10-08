<?php

/*
Template Name: My Soul
*/
get_header();

?>

<section class="soul_mate">
    <div class="vertical-align-container">
        <div class="vertical-align-block">
            <div class="container">
                <div class="row justify-content-center mb-5 sm-mb-3">
                    <div class="col-md-10 text-center">
                        <h2 style="border-bottom: none;" class="the_quest title divider mb-3 text-shadow">My Quest for
                            Girls</h2>
                        <b class="hr anim"></b>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">

                    <?php
                    if(is_user_logged_in()){
                        ?>
                    <div style="z-index: 98" class="col-md-12">
                        <a href="#ex1" rel="modal:open">
                            <div class="timeline-badge timeline-badge_female"><img
                                    class="front_page_img img-fluid female_arrow" src="<?php
                                        if(get_user_meta($user_ID, 'gender', true) == "Male"){
                                            echo get_template_directory_uri() . '/assets/images/timeline/female_rotate.png';
                                        }else{
                                            echo get_template_directory_uri() . '/assets/images/timeline/male.png';
                                        }
                                        ?>" alt="" /></div>
                        </a>
                        <div class="timeline-panel">
                            <div class="timeline-heading text-center">


                                <h4 class="timeline-title divider-3">
                                    <?php
                                        if(get_user_meta($user_ID, 'gender', true) == "Male"){
                                            echo "Let's Look";?> <span style="text-transform: lowercase;"> for</span> <?php echo "Girls";
                                        }else{
                                            echo "Let's Look";?> <span style="text-transform: lowercase;"> for</span> <?php echo "Guys";
                                        }
                                        ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    }else{
                        ?>
                    <div style="z-index: 98" class="col-md-6">
                        <a class="girls_link" href="#ex1" rel="modal:open">
                            <div class="timeline-badge timeline-badge_female"><img
                                    class="front_page_img img-fluid female_arrow" src="<?php
                                        
                                            echo get_template_directory_uri() . '/assets/images/timeline/female_rotate.png';
                                        
                                        ?>" alt="" /></div>
                        </a>
                        <div class="timeline-panel">
                            <div class="timeline-heading text-center">


                                <h4 class="timeline-title divider-3 search_female">
                                    <?php
                                            echo "Let's Look";?> <span style="text-transform lowercase;"> for</span> <?php echo "Girls";
                                        ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                    <div style="z-index: 98" class="col-md-6">
                        <a class="guys_link" href="#ex1">
                            <div class="timeline-badge timeline-badge_female"><img
                                    class="front_page_img img-fluid female_arrow" src="<?php
                                        
                                            echo get_template_directory_uri() . '/assets/images/timeline/male.png';
                                        ?>" alt="" /></div>
                        </a>
                        <div class="timeline-panel">
                            <div class="timeline-heading text-center">


                                <h4 class="timeline-title divider-3 create_male">
                                    <?php
                                            echo "Let's Look";?> <span style="text-transform lowercase;"> for</span> <?php echo "Guys";
                                        ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>


                </div>

            </div>

        </div>
        <!-- Search form -->
        <div id="ex1" class="modal">
            <a href="#" rel="modal:close" class="close_popup"></a>

            <input class="male_page_hidden" type="text"
                value="<?php echo home_url('male') ?>">
            <input class="female_page_hidden" type="text"
                value="<?php echo home_url('female-page') ?>">
            <p class="soul_text">Search for women to fulfill your fantasies.....</p>
            <form method="POST">
                <p id="search_label" for="">Age</p>
                <div class="search_flex_container">

                    <div class="search_flex_row">

                        <select name="age_from" id="age_from">
                            <option value="">from</option>
                            <?php
                        for ($i = 18; $i < 70; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        } ?>
                        </select>
                    </div>
                    <div class="search_flex_row">

                        <select name="age_to" id="age_from">
                            <option value="">to</option>
                            <?php
                    for ($i = 19; $i < 70; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                        </select>
                    </div>
                    <div class="search_flex_row">
                        <label id="search_label" for="state">State</label>
                        <select name="state">
                            <option value=""></option>
                            <option value="Alabama">Alabama</option>
                            <option value="Alaska">Alaska</option>
                            <option value="Arizona">Arizona</option>
                            <option value="Arkansas">Arkansas</option>
                            <option value="California">California</option>
                            <option value="Connecticut">Connecticut</option>
                            <option value="Delaware">Delaware</option>
                            <option value="Florida">Florida</option>
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
                    <div class="search_flex_row" style="margin-top: 20px;">
                        <span class="label city_label">City / Town</span><br>
                        <input name="city" type="text" id="inp" placeholder="&nbsp;">

                    </div>
                    <div class="search_flex_row">
                        <label id="search_label" for="status">I'm looking for.....</label>
                        <select name="status"><br />
                            <option value=""></option>
                            <option value="Serious relationships">Serious relationships</option>
                            <option value="Never married">Never married</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
                    </div>
                    <a href="#" rel="modal:close"><button type="button"
                            class="ajax_search jquery-modal modal_button button btn-lg btn-theme full-rounded animated right-icn">Search</button></a>

                </div>

            </form>

        </div>
        <!-- Search form -->
    </div>
    <!-- Search Result -->

    <!-- End of Search Result -->
</section>
<section class="search_reslt">
    <div class="container">
        <div class="row">
            <div class="search_grid_container">
            </div>
        </div>
    </div>
</section>
<?php 
//Getting user IP and insert into DB
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else{
	$ip_address = $_SERVER['REMOTE_ADDR'];
}
var_dump($ip_address);
?>
<script>



    var geocomp = [];
    TeleportAutocomplete.init('#inp').on('change', function (value) {
        if (value !== null) {
            geocomp = value;
            console.log(value)
        }
    });

    $('.ajax_search').on('click', function () {

        $.get('<?php echo site_url() ?>/wp-json/wp/v2/users?_fields[]=id&_fields[]=state&_fields[]=city&_fields[]=age&_fields[]=slug&_fields[]=relationship&_fields[]=profile_image&per_page=100',
            function (response) {
                $('.search_grid_container').html('')
                var response_array = [];

                $.each(response, function (i, item) {
                    if ((response[i].state == $('[name=state]').val() || $('[name=state]').val() ==
                            '') && (response[i].city == $('[name=city]').val() || $('[name=city]')
                            .val() == '') && (response[i].relationship == $('[name=status]')
                            .val() || $('[name=status]').val() == '') && (response[i].age >= $(
                            '[name=age_from]').val() || $('[name=age_from]').val() == '') && (
                            response[i].age <= $('[name=age_to]').val() || $('[name=age_to]')
                            .val() == '')) {
                        response_array.push(response[i]);
                        $('.search_grid_container').append(
                            '<div class="search_grid_item"><a target="_blank" href="<?php echo site_url() ?>/profile/?w1=' +
                            response[i].id + '"><img src=' + response[i].profile_image +
                            '></a><div class="user_slug">' + response[i].slug + '</div></div>')
                    }
                });
                console.log(response_array)
            });
    })

    //checking gender
   

var gender = ''


    var ip_match = 0

           
        

        $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=check_ip' ?>',
        function(response) {
           var check = JSON.parse(response)
           for(var i = 0; i < check.length; i++){
               if('<?php echo $ip_address ?>'.localeCompare(check[i]['ip']) == 0){
                    ip_match++
               }
           }


           $('.girls_link').on('click', (a)=>{
               
               
               if(localStorage.getItem('joined')  == 'Male'){
                   a.preventDefault()
                   alert('are you pussy?')
               }else if(localStorage.getItem('joined') == null){
                $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=update_gender&ip=' ?>' + '<?php echo $ip_address ?>' + '&gender=Female')
               }
           })

           $('.guys_link').on('click', (a)=>{
               if(localStorage.getItem('joined') == 'Female'){
                   a.preventDefault()
                   alert('please, tell us about your dick thickness')
               }else if(localStorage.getItem('joined') == null){
                $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=update_gender&ip=' ?>' + '<?php echo $ip_address ?>' + '&gender=Male')
               }
           })

           
           if(ip_match == 0){
            $.post('<?php echo get_template_directory_uri() . '/inc/chat_ajax.php?action=insert_ip&ip=' ?>' + '<?php echo $ip_address ?>' + '&gender=N/A');
           }

        });


    if(localStorage.getItem('joined') == 'Male'){
        $('.male_page_hidden').val('<?php echo home_url('male-registration') ?>')

    }
    if(localStorage.getItem('joined') == 'Female'){
        $('.female_page_hidden').val('<?php echo home_url('Female-registration') ?>')

    }
</script>


<?php
get_footer();