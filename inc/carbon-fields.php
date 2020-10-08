<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{


    Container::make('post_meta', 'Front Page Video')
        ->where('post_id', '=', 7)
        ->add_fields(array(
            Field::make('text', 'text_for_second_slide', 'Text for second slide'),
            Field::make('text', 'text_for_third_slide', 'Text for third slide'),
            Field::make('text', 'text_for_fourth_slide', 'Text for fourth slide'),
            Field::make('text', 'text_for_fifth_slide', 'Text for fifth slide'),
            Field::make('text', 'text_for_sixth_slide', 'Text for sixth slide'),
        ));
        
    Container::make('post_meta', 'Private Images')
    
        ->where('post_type', '=', 'attachment')
        ->add_fields(array(
            Field::make('text', 'private_video', 'Set private video'),
            Field::make('text', 'unset_private_video', 'Unset private video'),
            Field::make('text','privat_image', 'here should be private image'),
            Field::make('checkbox', 'crb_show_content', 'Show content')
                ->set_option_value('yes')
                ->set_visible_in_rest_api( true )
        ));
        Container::make('post_meta', 'External source url')
        ->where( 'post_type', '=', 'couple_blog')
        ->add_fields(array(
            Field::make('text', 'external_url', 'Past here the url of this blog'),
        ));
}